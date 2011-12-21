<?php
/*---------------------------------------------------------------------------
  UserInterface								2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections
  Class		: UserInterface
  -	Interface to UserCollection methods
---------------------------------------------------------------------------*/
namespace Database\Collections;

interface ModelInterface
{
  public function Load(\Models\Model $model);
  public function Save(\Models\Model $model);
  public function Remove(\Models\Model $model);
}
?>
