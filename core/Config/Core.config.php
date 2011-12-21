<?php
define('MINT_ROOT', getcwd().'/');
define('AKISMET_API_KEY', '4b66e21dd53c');
$SessionName = 'mint';
$Timezone = 'America/New_York';
if(file_exists('../../config/Core.config.php'))
{
  include('../../config/Core.config.php');
}
?>
