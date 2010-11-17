
<?php
if (!defined ("TYPO3_MODE"))     die ("Access denied.");
if(TYPO3_MODE=='FE') require_once(t3lib_extMgm::extPath('htmlawed_tidy').'class.user_tidyHTML.php');
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][] = 'user_tidyHTML->user_contentPostProc_all'; 
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-cached'][] = 'user_tidyHTML->user_contentPostProc_cached'; 
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 'user_tidyHTML->user_contentPostProc_output'; 
?>

