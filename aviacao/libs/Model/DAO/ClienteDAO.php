<?php
/** @package Aviacao::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("ClienteMap.php");

/**
 * ClienteDAO provides object-oriented access to the cliente table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Aviacao::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ClienteDAO extends Phreezable
{
	/** @var int */
	public $Id;

	/** @var char */
	public $Nome;

	/** @var char */
	public $Email;

	/** @var int */
	public $Cpf;


	/**
	 * Returns a dataset of Aeronave objects with matching IdCliente
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetIdAeronaves($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "aeronave_ibfk_1", $criteria);
	}


}
?>