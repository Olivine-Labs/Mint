<?php
ob_start();
include './Config/Core.config.php';
include './Common/functions.inc.php';

spl_autoload_register('\Common\LoadClass');

date_default_timezone_set($Timezone);

set_exception_handler('\Log::ExceptionHandler');
set_error_handler('\Log::ErrorHandler');

session_set_save_handler(
  array("\Classes\SessionHandler", "Open"),
  array("\Classes\SessionHandler", "Close"),
  array("\Classes\SessionHandler", "Read"),
  array("\Classes\SessionHandler", "Write"),
  array("\Classes\SessionHandler", "Destroy"),
  array("\Classes\SessionHandler", "GC")
);

session_name($SessionName);
session_start();

register_shutdown_function(
  '\Common\Shutdown',
  new \Templates\Mustache(),
  new \Templates\Controller(),
  \Context::getInstance(),
  new \Log()
);
?>
