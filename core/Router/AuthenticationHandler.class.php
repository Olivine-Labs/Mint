<?php
/*---------------------------------------------------------------------------
  AuthenticationHandler									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Router
  Class		  : AuthenticationHandler
---------------------------------------------------------------------------*/
namespace Router;

abstract class AuthenticationHandler extends \Router\Handler
{
  protected $_currentUser = null;

  protected function isAuthenticated()
  {
    if(array_key_exists('_token', $this->_request))
    {
      $user = \Controllers\Users::GetByToken(trim($this->_request['_token']),trim($this->_request['_userid']));
      if($user !== null)
      {
        return true;
      }
    }
    else
    {
      if($this->_context->CurrentUser->LoggedIn)
      {
        return true;
      }
    }
    return false;
  }

  protected function currentUser()
  {
    if($this->_currentUser == null)
    {
      if(array_key_exists('_token', $this->_request))
      {
        $this::setCurrentContextUser(\Controllers\Users::GetByToken(trim($this->_request['_token']),trim($this->_request['_userid'])));
      }
      else
      {
        $this->_currentUser = $this->_context->CurrentUser;
        if($this->_currentUser->Id == "")
          $this->_currentUser->Id = " ";
      }
    }

    return $this->_currentUser;
  }


  protected function setCurrentContextUser(\Models\User $user)
  {
    $user->LoggedIn = true;
    $this->_currentUser = $user;
    $this->_context->CurrentUser = $user;
    $this->_session->Data[\Models\Session::FIELD_USER] = (array)$user;
  }
}
?>
