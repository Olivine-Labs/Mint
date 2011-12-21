<?php
/*---------------------------------------------------------------------------
  Database									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database
  Class		: Controller
  -	abstract class - descends from singleton
---------------------------------------------------------------------------*/
namespace Database;

class Controller extends \Classes\Singleton
{
  protected	static	$_collectionTypes	= array();
  protected	static	$_collections		= array();

  protected function __construct()
  {
    include CONFIG_DIR.'Database.config.php';
  }

  protected function addCollection($settings)
  {
    self::$_collectionTypes[$settings->Name] = $settings;
  }

  public function __get($property)
  {
    if(array_key_exists($property, self::$_collectionTypes))
    {
      if(!array_key_exists($property, self::$_collections))
      {
        self::$_collections[$property] = new self::$_collectionTypes[$property]->ClassName(self::$_collectionTypes[$property]);
      }
    }
    else
    {
      throw new \Exception('Attempted to use non-existent database collection '.$property.'. Please ensure the collection exists and is set up properly.');
    }
    return self::$_collections[$property];
  }
}
?>
