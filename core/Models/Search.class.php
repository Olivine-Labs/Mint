<?php
/*---------------------------------------------------------------------------
  Search										2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Models
  Class		  : Search
---------------------------------------------------------------------------*/
namespace Models;

class Search extends Model
{
  public $SortField = null;
  public $SortDirection = 1;
  public $Limit = 20;
  public $Skip = 0;

  public function __construct()
  {
    parent::__construct();
  }

  public function Verify()
  {
    return true;
  }
}
?>
