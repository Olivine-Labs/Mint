<?php
/*---------------------------------------------------------------------------
  StatisticCollection							2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections\MongoDB
  Class		: StatisticCollection
  -	Class containing methods to access statistics in MongoDB
---------------------------------------------------------------------------*/
namespace Database\Collections\MongoDB;

class StatisticCollection extends Collection implements \Database\Collections\StatisticInterface
{
  public function Load($id)
  {
    return $this->Collection->findOne(array('_id' => new \MongoId($id)));
  }
}
?>
