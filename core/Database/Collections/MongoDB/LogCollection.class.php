<?php
/*---------------------------------------------------------------------------
  LogCollection								2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: Database\Collections\MongoDB
  Class		: LogCollection
  -	Class containing methods to access logs in MongoDB
---------------------------------------------------------------------------*/
namespace Database\Collections\MongoDB;

class LogCollection extends Collection implements \Database\Collections\LogInterface
{
  const	FIELD_SUBJECT			  = 'Subject';
  const	FIELD_MESSAGE			  = 'Message';
  const	FIELD_SEVERITY			= 'Severity';
  const	FIELD_STACKTRACE		= 'StackTrace';
  const	FIELD_TIMESTAMP			= 'TimeStamp';

  public function Add($subject, $message, $severity, $stackTrace)
  {
    $timestamp = time();
    $array = array(
      self::FIELD_SUBJECT		=> $subject,
      self::FIELD_MESSAGE		=> $message,
      self::FIELD_SEVERITY	=> $severity,
      self::FIELD_STACKTRACE=> $stackTrace,
      self::FIELD_TIMESTAMP	=> new \MongoDate($timestamp)
    );

    return $this->Collection->save($array);
  }
}
?>
