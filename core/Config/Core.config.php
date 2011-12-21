<?php
define('MINT_ROOT', getcwd().'/');
define('AKISMET_API_KEY', '4b66e21dd53c');
define('NAMESPACE_CUSTOM', MINT_ROOT.'../../core-custom/');
define('HANDLER_DIR', MINT_ROOT.'../../handlers/');
define('VIEW_DIR', MINT_ROOT.'../../views/');
define('CONFIG_DIR', MINT_ROOT.'../config/');
$SessionName = 'mint';
$Timezone = 'America/New_York';
if(file_exists('../../config/Core.config.php'))
{
  include('../../config/Core.config.php');
}
?>
