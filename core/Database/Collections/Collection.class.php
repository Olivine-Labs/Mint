<?php
/*---------------------------------------------------------------------------
  Collection									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections
  Class		: Collection
  -	Abstract class
---------------------------------------------------------------------------*/
namespace Database\Collections;

abstract class Collection
{
  protected	static	$Type			    = null;
  protected			    $Connection 	= null;
  protected			    $Settings 		= null;
  public				    $Connected		= false;

  public function __construct(\Database\Settings $settings)
  {
    $this->Settings = $settings;
    $this->connect();
  }

  abstract protected function connect();

  abstract public function transaction();
  abstract public function commit();
  abstract public function rollBack();
}
?>
