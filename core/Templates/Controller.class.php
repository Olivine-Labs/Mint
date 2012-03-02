<?php
/*---------------------------------------------------------------------------
  Controller									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Templates
  Class		: Controller
---------------------------------------------------------------------------*/
namespace Templates;

class Controller
{
  private static $_statusCode = 200;
  private static $_template = 'public/index';
  private static $_templateTypes = array();

  private static $_defaultStatusCodesByVerb = array("GET" => 200, "POST" => 201, "PUT" => 200, "DELETE" => 200);
  private static $_fullStatusHeaders = array(200 => "200 OK", 201 => "201 Created", 202 => "202 Accepted", 301 => "301 Moved Permanently", 304 => "304 Not Modified", 307 => "307 Temporary Redirect", 403 => "403 Forbidden", 404 => "404 Not Found", 405 => "405 Method Not Allowed", 410 => "410 Gone", 500 => "500 Internal Server Error", 501 => "501 Not Implemented", 503 => "503 Service Unavailable");
  private static $_outputTypeByContentType = array('x-www-form-urlencoded' => "text/html", "text/html" => "text/html", 'html' => "text/html", "json" => "application/json", "css" => "text/css", "rss" => "application/xml");
  private static $_contentType = null;

  public static $Renderers = array();

  private static function fillTypes()
  {
    if(!self::$_templateTypes)
    {
      self::$_templateTypes[] = 'x-www-form-urlencoded';
      self::$_templateTypes[] = 'html';
      self::$_templateTypes[] = 'css';
      self::$_templateTypes[] = 'rss';
    }
  }

  public static function getContentType()
  {
    self::fillTypes();
    if(array_key_exists('_type', $_REQUEST))
      return $_REQUEST['_type'];

    if(self::$_contentType !== null)
      return self::$_contentType;

    if(array_key_exists('CONTENT_TYPE', $_SERVER) && $_SERVER['CONTENT_TYPE'])
    {
      $temp = explode('/', $_SERVER['CONTENT_TYPE']);

      if(is_array($temp))
        $temp = end($temp);

      if(in_array($temp, self::$_templateTypes))
        return 'html';

      return $temp;
    }

    return 'html';
  }

  public static function getTemplateExt()
  {
    self::fillTypes();
    $ext = '.php';

    $temp = self::getContentType();

    if(in_array($temp, self::$_templateTypes))
      $ext = '.mustache';

    return $ext;
  }

  public static function render($file, $renderer = null, $context = null)
  {
    if(self::getTemplateExt() == '.php')
    {
      if(file_exists($file))
        include $file;
      return;
    }
    if($context === null)
      $context = \Context::getInstance();
    $template = false;
    if(file_exists($file))
      $template = file_get_contents($file);
    if($template !== false)
    {
      $partials = array();
      $contextObject = $context->ToObject();
      if(property_exists($contextObject, 'partials'))
      {
        $partials = (array)$contextObject->partials;
      }
      $contextObject->partials = null;

      if($renderer)
      {
        return $renderer->render(
          $template,
          $contextObject,
          $partials
        );
      }
      else
      {
        return $template;
      }
    }
    else
    {
      return 'Failed to load template "'.$file.'"';
    }
  }

  public static function SetTemplate($template)
  {
    self::$_template = $template;
  }

  public static function LoadTemplate($template)
  {
    $context = \Context::getInstance();
    $file = VIEW_DIR.$context->CurrentUser->Profile->Template.'/'.self::getContentType().'/'.$template.self::getTemplateExt();
    $template = self::render($file);
    return $template;
  }

  public static function SetHTTPStatusCode($code)
  {
    if(array_key_exists($code, self::$_fullStatusHeaders)){
      self::$_statusCode = $code;
    }
  }

  public static function SetContentType($contentType)
  {
    self::$_contentType = $contentType;
  }

  private static function getOutputType()
  {
    $outputType = "text/html";

    if(array_key_exists(self::$_contentType, self::$_outputTypeByContentType)){
      $outputType = self::$_outputTypeByContentType[self::$_contentType];
    }

    return $outputType;
  }

  public static function Output($renderer, $context = null)
  {
    if($context === null)
      $context = \Context::getInstance();

    if(self::$_statusCode == null){
      self::$_statusCode = self::$_defaultStatusCodesByVerb[$_SERVER['REQUEST_METHOD']];
    }

    header('Status: '.self::$_fullStatusHeaders[self::$_statusCode]);
    header('Content-type: ' . self::getOutputType());

    if(self::$_template !== null)
    {
      $file = VIEW_DIR.$context->CurrentUser->Profile->Template.'/'.self::getContentType().'/'.self::$_template.self::getTemplateExt();
      echo self::render($file, $renderer, $context);
    }
  }
}
?>


