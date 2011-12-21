<?php
/*---------------------------------------------------------------------------
  Log									2011 Olivine Labs
-----------------------------------------------------------------------------
  Namespace	: \
  Class		: Log
  -	Static
  -	Abstracts log file/database access
---------------------------------------------------------------------------*/

class LogErrorException extends Exception
{
  /**
   * The PHP Error Context
   *
   * The fifth parameter is optional, errcontext, which is an array that points to the active symbol table at the point the error occurred. In other words, errcontext  will contain an array of every variable that existed in the scope the error was triggered in. User error handler must not modify error context.
   */
  private $m_arContext;

  /**
   * Constructor
   */
  public function __construct($vMessage, $vCode, $vFile, $vLine, $arContext = null)
  {
    parent::__construct($vMessage, $vCode);

    $this->file = $vFile;
    $this->line = $vLine;

    $this->m_arContext = $arContext;
  }
}


class Log
{
  public		static	$Severity	= array(
    'FATAL'		=>200, 
    'ERROR'		=>100,
    'WARNING'	=>50,
    'INFO'		=>10,
    'DEBUG'		=>0
  );

  public    static  $ErrorTemplate  = null;
  public		static	$File           = null;

  public    static  $Verbose        = false;

  public    static  $ToTemplate     = true;
  public    static  $ToDatabase     = true;
  public    static  $ToFile         = true;

  private static function toTemplate($subject, $message, $severity, $stackTrace, $context = null)
  {
    if(ob_get_level())
      ob_end_clean();
    ob_start();
    if($context === null)
      $context = \Context::getInstance();

    $context->error->message    = $message;
    $context->error->severity   = array_search($severity, self::$Severity);
    $context->error->stackTrace = $stackTrace;
    $context->error->subject    = $subject;
    $context->error->verbose    = self::$Verbose;
    $context->partials->header = \Templates\Controller::LoadTemplate('public/header');
    $context->partials->footer = \Templates\Controller::LoadTemplate('public/footer');

    \Templates\Controller::SetTemplate(self::$ErrorTemplate);
    header("HTTP/1.0 500 Internal Server Error");
  }

  private static function toDatabase($subject, $message, $severity, $stackTrace)
  {
    \Database\Controller::getInstance()->Logs->Add(
      $subject,
      $message,
      $severity,
      $stackTrace
    );
  }

  private static function toFile($subject, $message, $severity, $stackTrace)
  {
    file_put_contents(
      self::$File,
      date("Y/m/d h:i:s a", time())."\t".$subject."\t".$severity."\t".$message."\t".$stackTrace.PHP_EOL,
      FILE_APPEND
    );
  }

  private static function arrayToHTML($array)
  {
    ob_start();
    var_dump($array);
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
  }

  public static function Message($subject, $message, $severity, $stackTrace, $context = null, $database=true, $die=false, $template=true)
  {
    if(is_array($stackTrace))
      $stackTrace = self::arrayToHTML($stackTrace);

    //Log to error template
    if($template && self::$ToTemplate)
    {
      try
      {
        self::toTemplate(
          $subject,
          $message,
          $severity,
          $stackTrace,
          $context
        );
      }
      catch(\Exception $e){/* Do Nothing, cannot log */}
    }

    //Log to Database
    if($database && self::$ToDatabase)
    {
      try
      {
        self::toDatabase(
          $subject,
          $message,
          $severity,
          $stackTrace
        );
      }
      catch(\Exception $e){/* Do Nothing, cannot log */}
    }

    //Log to File
    if(self::$ToFile)
    {
      try
      {
        self::toFile(
          $subject,
          $message,
          $severity,
          $stackTrace
        );
      }
      catch(\Exception $e){/* Do Nothing, cannot log */}
    }

    if($die)
      exit();
  }

  public static function ExceptionHandler($exception, $context = null)
  {
    if($context === null)
      $context = \Context::getInstance();

    $context->exception = $exception;

    self::Message(
      'RUNTIME',
      $exception->getMessage()." in ".$exception->getFile().":".$exception->getLine(),
      self::$Severity['ERROR'],
      $exception->getTrace(),
      $context
    );
  }

  public static function ErrorHandler($level, $message, $file, $line, $context)
  {
    throw new LogErrorException(
      $message,
      $level,
      $file,
      $line,
      $context
    );
  }
}

include(CONFIG_DIR.'Log.config.php');
Log::$ErrorTemplate  = $TemplateFile;
Log::$File           = $LogFile;

Log::$Verbose        = $Verbose;

Log::$ToTemplate     = $TemplateEnabled;
Log::$ToDatabase     = $DatabaseEnabled;
Log::$ToFile         = $FileEnabled;

?>
