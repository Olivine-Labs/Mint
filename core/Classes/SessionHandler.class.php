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
    $aSession = new \Models\Session();
    $aSession->SessionId = $sessionId;
    \Database\Controller::getInstance()->Sessions->LoadBySessionId($aSession);
    self::$_session = $aSession;
    $_SESSION = $aSession->Data;
    return self::$_session->Data;
  }

  public static function Write($sessionId, $data)
  {
    $aSession = self::$_session;
    $aSession->Data = array_merge($_SESSION, $aSession->Data);
    return \Database\Controller::getInstance()->Sessions->Save(self::$_session);
  }

  public static function Destroy($sessionId)
  {
    return \Database\Controller::getInstance()->Sessions->Remove(self::$_session);
  }

  public static function GC($maxLifeTime)
  {
    \Database\Controller::getInstance()->Sessions->Cleanup();
    return true;
  }

  public static function getSession()
  {
    return self::$_session;
  }
}
?>
