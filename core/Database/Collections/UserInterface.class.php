<?php
/*---------------------------------------------------------------------------
  UserInterface								2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections
  Class		: UserInterface
  -	Interface to UserCollection methods
---------------------------------------------------------------------------*/
namespace Database\Collections;

interface UserInterface extends ModelInterface
{
  public function LoadByName(\Models\User $user);
  public function LoadByEmail(\Models\User $user);
  public function ChangeScore(\Models\User $user);
}
?>
