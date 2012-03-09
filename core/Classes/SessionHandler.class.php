<?php
/*---------------------------------------------------------------------------
  SessionHandler									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Classes
  Class		: SessionHandler
  -	Static
  -	Abstracts session handling
---------------------------------------------------------------------------*/
namespace Classes;

class SessionHandler
{
  private static $_session = null;

  public static function Open($savePath, $sessionName)
  {
    return true;
  }

  public static function Close()
  {
    return true;
  }

  public static function Read($sessionId)
  {
    $session = new \Models\Session();
    $session->SessionId = $sessionId;
    \Database\Controller::getInstance()->Sessions->Load($session);
    self::$_session = $session;
    return self::$_session->Data;
  }

  public static function Write($sessionId, $data)
  {
    return \Database\Controller::getInstance()->Sessions->Save(self::$_session);
  }

  public static function Destroy($sessionId)
  {
    return \Database\Controller::getInstance()->Sessions->Remove(self::$_session);
  }

  public static function GC($maxLifeTime)
  {
    \Database\Controller::getInstance()->Sessions->Cleanup($maxLifeTime);
    return true;
  }

  public static function getSession()
  {
    return self::$_session;
  }
}
?>
