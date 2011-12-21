<?php
/*---------------------------------------------------------------------------
  Profile										2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Models
  Class		  : Profile
---------------------------------------------------------------------------*/
namespace Models;

class Profile extends Model
{
  public    $Template   = 'default';

  public function __construct()
  {
    parent::__construct();
  }
}
?>
