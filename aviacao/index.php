<?php
/** @package    AVIACAO */

include_once("_global_config.php");
include_once("_app_config.php");
@include_once("_machine_config.php");

if (!GlobalConfig::$CONNECTION_SETTING)
{
	throw new Exception('GlobalConfig::$CONNECTION_SETTING is not configured.  Are you missing _machine_config.php?');
}


require_once("verysimple/Phreeze/Dispatcher.php");


$gc = GlobalConfig::GetInstance();

try
{
	Dispatcher::Dispatch(
		$gc->GetPhreezer(),
		$gc->GetRenderEngine(),
		'',
		$gc->GetContext(),
		$gc->GetRouter()
	);
}
catch (exception $ex)
{
	
	
	$url = RequestUtil::GetCurrentURL();
	$isApiRequest = (strpos($url,'api/') !== false);
	
	if ($isApiRequest)
	{
		$result = new stdClass();
		$result->success= false;
		$result->message = $ex->getMessage();
		$result->data = $ex->getTraceAsString();
		
		@header('HTTP/1.1 401 Unauthorized');
		echo json_encode($result);
	}
	else
	{
		$gc->GetRenderEngine()->assign("message",$ex->getMessage());
		$gc->GetRenderEngine()->assign("stacktrace",$ex->getTraceAsString());
		$gc->GetRenderEngine()->assign("code",$ex->getCode());
		
		try
		{
			$gc->GetRenderEngine()->display("DefaultErrorFatal.tpl");
		}
		catch (Exception $ex2)
		{
	
			echo "<style>* { font-family: verdana, arial, helvetica, sans-serif; }</style>\n";
			echo "<h1>Fatal Error:</h1>\n";
			echo '<h3>' . htmlentities($ex->getMessage()) . "</h3>\n";
			echo "<h4>Original Stack Trace:</h4>\n";
			echo '<textarea wrap="off" style="height: 200px; width: 100%;">' . htmlentities($ex->getTraceAsString()) . '</textarea>';
			echo "<h4>In addition to the above error, the default error template could not be displayed:</h4>\n";
			echo '<textarea wrap="off" style="height: 200px; width: 100%;">' . htmlentities($ex2->getMessage()) . "\n\n" . htmlentities($ex2->getTraceAsString()) . '</textarea>';
		}
	}
}

?>