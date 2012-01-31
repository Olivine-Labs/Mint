<?php
$dir = __DIR__;
if($str[strlen($dir)-1] != '/' && $str[strlen($dir)-1] != '\\')
{
  $dir .= '/';
}
define('MINT_ROOT', $dir.'../../');
define('AKISMET_API_KEY', '4b66e21dd53c');
$SessionName = 'mint';
$Timezone = 'America/New_York';
if(file_exists(MINT_ROOT.'../../config/Core.config.php'))
{
  include(MINT_ROOT.'../../config/Core.config.php');
}
?>
