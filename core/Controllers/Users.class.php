<?php
/*---------------------------------------------------------------------------
  Users										2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Controllers
  Class		  : Users
---------------------------------------------------------------------------*/
namespace Controllers;

class Users
{
  public static function Login(\Models\User &$user)
  {
    $aUser = new \Models\User();
    $aUser->Email = strtolower($user->Email);
    $aUser->Domain = \Common\GetSubDomain();
    $aDatabase = \Database\Controller::getInstance();
    if($aDatabase->Users->LoadByEmail($aUser))
    {
      $aSession	= \Classes\SessionHandler::getSession();
      if(\Common\hash($user->Password) == $aUser->Password)
      {
        $aUser->Password = null;
        $user = $aUser;
        $aSession->Data[\Models\Session::FIELD_USER] = (array)$aUser;
        return true;
      }
    }
    return false;
  }

  public static function Logout()
  {
    $aSession = \Classes\SessionHandler::getSession();

    if(array_key_exists(\Models\Session::FIELD_USER, $aSession->Data))
    {
      $_SESSION = array();
      unset($aSession->Data[\Models\Session::FIELD_USER]);
    }
    return true;
  }

  public static function Register($user, $login = true)
  {
    $aDatabase = \Database\Controller::getInstance();
    $user->Domain = \Common\GetSubDomain();
    $user->Email = strtolower($user->Email);
    $Password = $user->Password;
    $user->Password = \Common\hash($user->Password);
    $user->Token = uniqid('', true);
    $user->UserId = uniqid('', true);
    if($aDatabase->Users->Save($user))
    {
      if($login)
      {
        $user->Password = $Password;
        $aSession = \Classes\SessionHandler::getSession();
        self::Login($user);
      }
      return true;
    }
    return false;
  }

  public static function View(\Models\User $user)
  {
    $aDatabase = \Database\Controller::getInstance();
    $user->Domain  = \Common\GetSubDomain();

    if($user->UserName)
    {
      if($aDatabase->Users->LoadByName($user))
      {
        return $user;
      }
    }
    else if($user->Email)
    {
      $user->Email = strtolower($user->Email);
      if($aDatabase->Users->LoadByEmail($user))
      {
        return $user;
      }
    }else if($user->Id){
      if($aDatabase->Users->Load($user))
      {
        return $user;
      }
    }

    return false;
  }

  public static function Edit(\Models\User $user)
  {
    $database = \Database\Controller::getInstance();
    return $database->Users->Save($user);
  }

  public static function GetByToken($token, $userId)
  {
    $aDatabase = \Database\Controller::getInstance();

    if($token)
    {
      $user = new \Models\User();
      $user->Token = $token;
      $user->UserId = $userId;
      if($aDatabase->Users->LoadByToken($user))
      {
        return $user;
      }
    }
    return null;
  }

  public static function GenerateToken($user)
  {
    $tempUser = new \Models\User();
    $tempUser->Id = $user->Id;

    $session = \Classes\SessionHandler::getSession();

    if(array_key_exists(\Models\Session::FIELD_USER, $session->Data))
    {
      $database = \Database\Controller::getInstance();

      if($database->Users->Load($tempUser))
      {
        $tempUser->Token = uniqid('', true);
        $tempUser->UserId = uniqid('', true);

        if($database->Users->Save($tempUser)){
          $session->Data[\Models\Session::FIELD_USER] = (array)$tempUser;

          return true;
        }
      }
    }

    return false;
  }
}
?>
