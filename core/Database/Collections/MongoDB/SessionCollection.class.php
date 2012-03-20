<?php
/*---------------------------------------------------------------------------
  SessionCollection								2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections\MongoDB
  Class		: SessionCollection
  -	Class containing methods to access Sessions in MongoDB
---------------------------------------------------------------------------*/
namespace Database\Collections\MongoDB;

class SessionCollection extends Collection implements \Database\Collections\SessionInterface
{
  const FIELD_DATA        = 'Data';
  const FIELD_LASTACCESS  = 'LastAccess';
  const FIELD_SESSIONID   = 'SessionId';

  protected function toArray(\Models\Model $model)
  {
    $result = parent::toArray($model);
    $result[self::FIELD_LASTACCESS] = (array_key_exists(self::FIELD_LASTACCESS, $result))?new \MongoDate($result[self::FIELD_LASTACCESS]):new \MongoDate();
    return $result;
  }

  public function Load(\Models\Model $model)
  {
    $id = $model->SessionId;
    $data = $this->Collection->findOne(array(self::FIELD_SESSIONID => $id));
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
      $this->Collection->save($array);
    }
    catch(\Exception $e)
    {
      return false;
    }
    return true;
  }

  public function Remove(\Models\Model $model)
  {
    $id = new \MongoId($model->SessionId);
    $data = $this->Collection->remove(array(self::FIELD_SESSIONID => $id));
    return true;
  }



  public function Cleanup($time)
  {
    try
    {
      $searchArray = array(self::FIELD_LASTACCESS =>array('$lte', new \MongoDate($time)));
      $data = $this->Collection->remove($searchArray);
      return true;
    }
    catch(\Exception $e)
    {}
    return false;
  }
}
?>
