<?php
define('MINT_ROOT', __DIR__.'/../../');
define('AKISMET_API_KEY', '4b66e21dd53c');
$SessionName = 'mint';
$Timezone = 'America/New_York';
if(file_exists(MINT_ROOT.'../../config/Core.config.php'))
{
  include(MINT_ROOT.'../../config/Core.config.php');
}
?>
