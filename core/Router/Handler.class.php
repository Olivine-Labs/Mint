<?php
/*---------------------------------------------------------------------------
  Handler									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Router
  Class		  : Handler
---------------------------------------------------------------------------*/
namespace Router;

abstract class Handler
{
  protected $_context = null;
  protected $_request = null;

  public function __construct(\Context $context, $request)
  {
    $this->_context = $context;
    $this->_request = $request;
  }

  public function PreRequest()
  {
    $session = \Classes\SessionHandler::getSession();

    if(!array_key_exists(\Models\Session::FIELD_USER, $session->Data) && array_key_exists("token", $this->_request)){
      $user = \Controllers\Users::GetByToken(trim($this->_request['_token']),trim($this->_request['_userid']));

      if($user !== null)
      {
        $user->LoggedIn = true;
        $session->Data[\Models\Session::FIELD_USER] = $user;
      }
    }
  }

  public abstract function Request();

  protected function redirect($url)
  {
    header('location: '.$url);
    \Templates\Controller::SetTemplate(null);
    exit;
  }

  protected function setTemplate($path)
  {
    \Templates\Controller::SetTemplate($path);
  }

  protected function addPartial($name, $path)
  {
    $this->_context->partials->$name = \Templates\Controller::LoadTemplate($path);
  }

  protected function setContentType($type)
  {
    \Templates\Controller::SetContentType($type);
  }

  protected function setHTTPStatusCode($code)
  {
    \Templates\Controller::SetHTTPStatusCode($type);
  }
}
?>
