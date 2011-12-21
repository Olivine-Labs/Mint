<?php
/*---------------------------------------------------------------------------
  Singleton	2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Classes
  Class		: Singleton
  -	Class
---------------------------------------------------------------------------*/
namespace Classes;

abstract class Singleton
{
  protected static $_instance = array();

  protected function  __construct() { }

  final private function  __clone() { }

  final public static function getInstance()
  {
    $class = get_called_class();
    if(!array_key_exists($class, static::$_instance))
    {
      static::$_instance[$class] = new static();
      static::$_instance[$class]->__init();
    }
    return static::$_instance[$class];
  }

  protected function __init(){}
}
?>
