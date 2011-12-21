<?php
/*---------------------------------------------------------------------------
  Quote										2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Models
  Class		: Search
---------------------------------------------------------------------------*/
namespace Models;

class Search extends Model
{
  public	$SortField			  = null;
  public	$SortDirection		= 1;
  public	$Limit				    = 10;
  public	$Skip				      = 0;
  public	$Keywords			    = array();
  public  $Domain           = null;
  public  $PostedBy         = null;
  public  $PostedByName     = null;

  public function __construct()
  {
    parent::__construct();
  }
}
?>
