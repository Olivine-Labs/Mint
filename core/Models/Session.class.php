<?php
/*---------------------------------------------------------------------------
  Session									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Models
  Class		: Session
---------------------------------------------------------------------------*/
namespace Models;

class Session extends Model
{
  const		FIELD_USER		= 'User';
  public    $SessionId= null;
  public		$Data			= null;

  public    $LastAccess = 0;

  public function __construct()
  {
    parent::__construct();
    $this->LastAccess = time();
    $this->Data = &$_SESSION;
  }
}
?>
