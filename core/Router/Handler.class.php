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
  protected $_session = null;

  public function __construct(\Context $context, $request)
  {
    $this->_context = $context;
    $this->_request = $request;
    $this->_session = \Classes\SessionHandler::getSession();
  }

  public function PreRequest()
  {

    if(!array_key_exists(\Models\Session::FIELD_USER, $this->_session->Data) && array_key_exists("_token", $this->_request)){
      $user = \Controllers\Users::GetByToken(trim($this->_request['_token']),trim($this->_request['_userid']));

      if($user !== null)
      {
        $user->Password = null;
        $this->_session->Data[\Models\Session::FIELD_USER] = (array)$user;
      }
    }
  }

  public abstract function Request();

  protected function redirect($url)
  {
    \Templates\Controller::SetHTTPStatusCode('302');
    header('Location: '.$url);
    \Templates\Controller::SetTemplate('errors/302');
    exit();
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
    \Templates\Controller::SetHTTPStatusCode($code);
  }
}
?>
