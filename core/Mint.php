<?php
include './Common/Common.inc.php';
//Fill Context by executing request handler
\Router\Controller::getInstance()->Execute(\Common\UriToArray($_SERVER['REQUEST_URI']));
?>
