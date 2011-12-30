<?php
/*---------------------------------------------------------------------------
  UserCollection								2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections\MongoDB
  Class		: UserCollection
  -	Class containing methods to access users in MongoDB
---------------------------------------------------------------------------*/
namespace Database\Collections\MongoDB;

class UserCollection extends Collection implements \Database\Collections\UserInterface
{
  const	FIELD_NAME			= 'UserName';
  const	FIELD_PASSWORD	= 'Password';
  const	FIELD_EMAIL			= 'Email';
  const FIELD_DOMAIN    = 'Domain';
  const FIELD_PROFILE   = 'Profile';
  const FIELD_SCORE     = 'Score';
  const FIELD_TOKEN     = 'Token';
  const FIELD_USERID    = 'UserId';

  protected function fill(\Models\Model $model, $array)
  {
    parent::fill($model, $array);
    $user = $model;
    $user->Profile  = ($user->Profile)?(object)$user->Profile:new \Models\Profile();
  }

  public function LoadByName(\Models\User $user)
  {
    $data = $this->Collection->findOne(array(
      self::FIELD_NAME			=> $user->UserName
    ));
    if($data)
    {
      self::fill($user, $data);
      return true;
    }
    else
    {
      return false;
    }
  }

  public function LoadByEmail(\Models\User $user)
  {
    $data = $this->Collection->findOne(array(
      self::FIELD_EMAIL			=> $user->Email
    ));
    if($data)
    {
      self::fill($user, $data);
      return true;
    }
    else
    {
      return false;
    }
  }

  public function LoadByToken(\Models\User $user)
  {
    $data = $this->Collection->findOne(array(
      self::FIELD_TOKEN			=> $user->Token,
      self::FIELD_USERID			=> $user->UserId
    ));
    if($data)
    {
      self::fill($user, $data);
      return true;
    }
    else
    {
      return false;
    }
  }

  public function ChangeScore(\Models\User $user)
  {
    try
    {
      $searchArray = array(self::FIELD_ID => new \MongoId($user->Id));

      $incArray = array('$inc'=>array(self::FIELD_SCORE=>$user->Score));

      $this->Collection->update($searchArray, $incArray);
    }
    catch(\Exception $e)
    {
      return false;
    }
    return true;
  }
}
?>
