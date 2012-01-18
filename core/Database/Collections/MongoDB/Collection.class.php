<?php
/*---------------------------------------------------------------------------
  Collection									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections\MongoDB
  Class		: Collection
  -	Abstract class
---------------------------------------------------------------------------*/
namespace Database\Collections\MongoDB;

abstract class Collection extends \Database\Collections\Collection
{
  const		FIELD_ID		= '_id';

  protected	$Collection		= null;

  protected function connect()
  {
    try
    {
      if(class_exists('\\Mongo', false))
      {
        $this->Connection = new \Mongo(
          'mongodb://'.$this->Settings->User.':'.$this->Settings->Password.'@'.$this->Settings->Host.':'.$this->Settings->Port.'/'.$this->Settings->Database,
          //'mongodb://'.$this->Settings->Host.':'.$this->Settings->Port.'/'.$this->Settings->Database,
          array("persist" => "x")
        );
        $this->Connected = $this->Connection->connect();
        $this->Collection = $this->Connection->selectCollection($this->Settings->Database, $this->Settings->Collection);
      }
      else
      {
        \Log::Message('SERVER', 'MongoDB Driver not installed', \Log::$Severity['FATAL'], debug_backtrace(), false, true);
      }
    }
    catch(\Exception $e)
    {
      \Log::Message('DATABASE', 'Failed to connect to database.', \Log::$Severity['FATAL'], $e->getTrace(), false, true);
    }
  }

  protected function fill(\Models\Model $model, $array)
  {
    foreach($array AS $property=>$value)
    {
      if($property === self::FIELD_ID)
      {
        $property = 'Id';
        $value = "$value";
      }
      else if(is_object($value))
      {
        $class = get_class($value);
        switch($class)
        {
        case 'MongoDate':
          $value = $value->sec;
          break;
        }
      }
      $model->$property = $value;
    }
  }

  protected function toArray(\Models\Model $model)
  {
    $result = array();
    foreach($model AS $property=>$value)
    {
      $result[$property] = $value;
    }

    if(array_key_exists('Id', $result))
    {
      $id = $result['Id'];
      $id = new \MongoId($id);
      $result[self::FIELD_ID] = $id;
      unset($result['Id']);
    }
    return $result;
  }

  public function Load(\Models\Model $model)
  {
    $id = $model->Id;
    $id = new \MongoId($id);
    $data = $this->Collection->findOne(array(self::FIELD_ID => $id));
    if($data)
    {
      $this->fill($model, $data);
      return true;
    }
    else
    {
      return false;
    }
  }

  public function Save(\Models\Model $model, $returnId = true)
  {
    try
    {
      $array = $this->toArray($model);
      $this->Collection->save($array, array('safe'=>true));
      if($returnId)
        $model->Id = (string)$array[self::FIELD_ID];
    }
    catch(\Exception $e)
    {
      return false;
    }
    return true;
  }

  public function Remove(\Models\Model $model)
  {
    $id = $model->Id;
    $id = new \MongoId($id);
    $data = $this->Collection->remove(array(self::FIELD_ID => $id));
    return true;
  }

  final public function transaction(){  return true;/*	Not supported	*/}
  final public function commit(){       return true;/*	Not supported	*/}
  final public function rollBack(){     return true;/*	Not supported	*/}
}
?>
