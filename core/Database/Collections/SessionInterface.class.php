<?php
/*---------------------------------------------------------------------------
  SessionInterface							2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections
  Class		: SessionInterface
  -	Interface to SessionCollection methods
---------------------------------------------------------------------------*/
namespace Database\Collections;

interface SessionInterface extends ModelInterface 
{
  public function Cleanup($time);
}
?>
