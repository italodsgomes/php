<?php
/**
 * @package AVIACAO 
 
 */

require_once 'verysimple/Phreeze/ConnectionSetting.php';
require_once("verysimple/HTTP/RequestUtil.php");

GlobalConfig::$CONNECTION_SETTING = new ConnectionSetting();
GlobalConfig::$CONNECTION_SETTING->ConnectionString = "127.0.0.1:3307";
GlobalConfig::$CONNECTION_SETTING->DBName = "aviacao";
GlobalConfig::$CONNECTION_SETTING->Username = "root";
GlobalConfig::$CONNECTION_SETTING->Password = "";
GlobalConfig::$CONNECTION_SETTING->Type = "MySQL_PDO";
GlobalConfig::$CONNECTION_SETTING->Charset = "utf8";
GlobalConfig::$CONNECTION_SETTING->Multibyte = true;

GlobalConfig::$ROOT_URL = RequestUtil::GetServerRootUrl() . 'aviacao/';

if (!function_exists('lcfirst')) {
	function lcfirst($string) {
		return substr_replace($string, strtolower(substr($string, 0, 1)), 0, 1);
	}
}


if (GlobalConfig::$CONNECTION_SETTING->Multibyte && !function_exists('mb_strlen'))
	die('<html>Multibyte extensions are not installed but Multibyte is set to true in _machine_config.php</html>');



?>