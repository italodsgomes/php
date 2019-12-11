<?php
/** @package    Aviacao::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * AeronaveMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the AeronaveDAO to the aeronave datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Aviacao::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class AeronaveMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Id"] = new FieldMap("Id","aeronave","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["IdCliente"] = new FieldMap("IdCliente","aeronave","id_cliente",false,FM_TYPE_INT,11,null,false);
			self::$FM["Matricula"] = new FieldMap("Matricula","aeronave","matricula",false,FM_TYPE_CHAR,6,null,false);
			self::$FM["Modelo"] = new FieldMap("Modelo","aeronave","modelo",false,FM_TYPE_CHAR,50,null,false);
			self::$FM["Ano"] = new FieldMap("Ano","aeronave","ano",false,FM_TYPE_YEAR,4,null,false);
			self::$FM["Cor"] = new FieldMap("Cor","aeronave","cor",false,FM_TYPE_CHAR,50,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
			self::$KM["aeronave_ibfk_1"] = new KeyMap("aeronave_ibfk_1", "IdCliente", "Cliente", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return self::$KM;
	}

}

?>