<?php
/**
 * @package 
 
 */

/**
 * @package Adserv
 * @author ClassBuilder
 */
class GlobalConfig
{
	/** @var set  */
	public static $DEBUG_MODE = false;

	/** @var default */
	public static $DEFAULT_ACTION = "Default.Home";

	/** @var routemap */
	public static $ROUTE_MAP;

	/** @var specify */
	public static $TEMPLATE_ENGINE = 'SmartyRenderEngine';

	/** @var template  */
	public static $TEMPLATE_PATH;

	/** @var template */
	public static $TEMPLATE_CACHE_PATH;

	/** @var app  */
	public static $APP_ROOT;

	/** @var root  */
	public static $ROOT_URL;

	/** @var ConnectionSetting o**/
	public static $CONNECTION_SETTING;
	
	/** @var Setting **/
	public static $CONVERT_NULL_TO_EMPTYSTRING = true;

	/** @var ICache **/
	public static $LEVEL_2_CACHE;

	/** @var string  */
	public static $LEVEL_2_CACHE_TEMP_PATH;

	/** @var int*/
	public static $LEVEL_2_CACHE_TIMEOUT = 15;

	private static $INSTANCE;
	private static $IS_INITIALIZED = false;

	private $context;
	private $router;
	private $phreezer;
	private $render_engine;


	private function __construct(){}

	
	private function __clone() {}

	static function Init()
	{
		if (!self::$IS_INITIALIZED)
		{
			require_once 'verysimple/HTTP/RequestUtil.php';
			RequestUtil::NormalizeUrlRewrite();

			require_once 'verysimple/Phreeze/Controller.php';
			Controller::$SmartyViewPrefix = '';
			Controller::$DefaultRedirectMode = 'header';

			self::$IS_INITIALIZED = true;
		}

	}

	/**
	 * @return GlobalConfig
	 */
	static function GetInstance()
	{
		if (!self::$IS_INITIALIZED) self::Init();

		if (!self::$INSTANCE instanceof self) self::$INSTANCE = new self;

		return self::$INSTANCE;
	}

	/**
	 * @return Context
	 */
	function GetContext()
	{
		if ($this->context == null)
		{
		}
		return $this->context;

	}

	/**
	 * @return UrlWriter
	 */
	function GetRouter()
	{
		if ($this->router == null)
		{
			require_once("verysimple/Phreeze/GenericRouter.php");
			$this->router = new GenericRouter(self::$ROOT_URL,self::GetDefaultAction(),self::$ROUTE_MAP);
		}
		return $this->router;
	}


	/**
	* @return string
	*/
	function GetAction()
	{
		list($controller,$method) = $this->GetRouter()->GetRoute();
		return $controller.'.'.$method;
	}

	/**
	 * @return string
	 */
	function GetDefaultAction()
	{
		return self::$DEFAULT_ACTION;
	}

	/**
	 * @return Phreezer
	 */
	function GetPhreezer()
	{
		if ($this->phreezer == null)
		{
			if (!self::$CONVERT_NULL_TO_EMPTYSTRING)
			{
				require_once("verysimple/DB/DatabaseConfig.php");
				DatabaseConfig::$CONVERT_NULL_TO_EMPTYSTRING = false;
			}
			
			if (self::$DEBUG_MODE)
			{
				require_once("verysimple/Phreeze/ObserveToSmarty.php");
				$observer = new ObserveToSmarty($this->GetRenderEngine());
				$this->phreezer = new Phreezer(self::$CONNECTION_SETTING, $observer);
			}
			else
			{
				$this->phreezer = new Phreezer(self::$CONNECTION_SETTING);
			}

			if (self::$LEVEL_2_CACHE)
			{
				$this->phreezer->SetLevel2CacheProvider( self::$LEVEL_2_CACHE, self::$LEVEL_2_CACHE_TEMP_PATH );
				$this->phreezer->ValueCacheTimeout = self::$LEVEL_2_CACHE_TIMEOUT;
			}
		}

		return $this->phreezer;
	}

	/**
	 * @return IRenderEngine
	 */
	function GetRenderEngine()
	{
		if ($this->render_engine == null)
		{
			$engine_class = self::$TEMPLATE_ENGINE;
			if (!class_exists($engine_class))
			{
				require_once 'verysimple/Phreeze/'. $engine_class  . '.php';
			}
			$this->render_engine = new $engine_class(self::$TEMPLATE_PATH,self::$TEMPLATE_CACHE_PATH);
			$this->render_engine->assign("ROOT_URL",self::$ROOT_URL);
			$this->render_engine->assign("PHREEZE_VERSION",Phreezer::$Version);
			$this->render_engine->assign("PHREEZE_PHAR",Phreezer::PharPath());
		}

		return $this->render_engine;
	}

}

?>