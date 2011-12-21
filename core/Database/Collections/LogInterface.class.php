<?php
/*---------------------------------------------------------------------------
  LogInterface								2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections
  Class		: LogInterface
  -	Interface to LogCollection methods
---------------------------------------------------------------------------*/
namespace Database\Collections;

interface LogInterface extends ModelInterface
{
  public function Add($subject, $message, $severity, $stackTrace);
}
?>
