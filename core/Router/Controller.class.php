<?php
/*---------------------------------------------------------------------------
  Context										2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Router
  Class		  : Controller
---------------------------------------------------------------------------*/
namespace Router;

class Controller extends \Classes\Singleton
{
  private   $_parent        = null;
  private   $_data          = array();
  private   $_file          = null;

  protected $_currentIndex  = null;

  protected function __construct(\Router\Controller $parent = null, $index='')
  {
    $this->_parent        = $parent;
    $this->_currentIndex  = $index;
  }

  public function GetRoute()
  {
    if($this->_currentIndex)
      return $this->_parent->GetRoute().$this->_currentIndex.'/';
  }

  private static function getHandler($path, $file)
  {
    $handler = null;

    while(!file_exists($handler = $path.$file) && $path != MINT_ROOT)
    {
      $path = dirname($path).'/';
    }

    if($path == MINT_ROOT)
      $handler = null;

    return $handler;
  }

  private static function fillArray(&$array)
  {
    if($data = file_get_contents('php://input'))
      parse_str($data, $array);
  }

  private static function ensureRequestMethod()
  {
    if(array_key_exists('_method', $_REQUEST))
    {
      $_SERVER['REQUEST_METHOD'] = strtoupper($_REQUEST['_method']);
    }
  }

  public function Execute($pathArray = null)
  {
    $router = $this;

    if($pathArray)
      foreach($pathArray AS $key)
        $router = $router->{$key};

    self::ensureRequestMethod();

    $routeHandlerPath = HANDLER_DIR.$router->GetRoute();
    $handlerPath = null;

    $handlerPath = self::getHandler($routeHandlerPath, $_SERVER['REQUEST_METHOD'].'.handler.php');

    $context = \Context::getInstance();

    if($handlerPath !== null)
    {
      include $handlerPath;

      $handler = new \RequestHandler($context, $_REQUEST);
      $handler->PreRequest();
      $handler->Request();
    }
    else
    {
      header("HTTP/1.0 404 Not Found");
      $context->partials->header = \Templates\Controller::LoadTemplate('public/header');
      $context->partials->footer = \Templates\Controller::LoadTemplate('public/footer');
      \Templates\Controller::SetTemplate('errors/404');
    }
  }

  public final function __get($index)
  {
    return (array_key_exists($index, $this->_data))?$this->_data[$index]:$this->_data[$index] = new Controller($this, $index);
  }
}
?>
