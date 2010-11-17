<?php

########################################################################
# Extension Manager/Repository config file for ext "htmlawed_tidy".
#
# Auto generated 17-11-2010 16:41
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'htmLawed or Tidy html Cleanup',
	'description' => 'Can customize the Html tidy way : 

* htmlawed : see http://code.google.com/p/htmlawed/ 
* tidy : auto mode for tidy (use php5 tidy if available) 
* php5tidy : http://php.net/manual/en/ref.tidy.php 
* typo3_tidy : Typo3 original tidy function (use file cache)


more infos on http://forge.typo3.org/projects/show/extension-htmlawed_tidy',
	'category' => 'fe',
	'shy' => 0,
	'version' => '0.1.1',
	'dependencies' => '',
	'conflicts' => '0,1,2',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'nliaudat',
	'author_email' => 'nliaudat@pompiers-chatel.ch',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
		),
		'conflicts' => array(
			'0' => 'tstidy',
			'1' => 'abcsstidy',
			'2' => 'stfl_tidystdwrap',
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:11:{s:9:"ChangeLog";s:4:"3612";s:23:"class.user_tidyHTML.php";s:4:"8663";s:21:"ext_conf_template.txt";s:4:"3144";s:12:"ext_icon.gif";s:4:"8af6";s:17:"ext_localconf.php";s:4:"53e5";s:34:"config/htmlawed_default_preset.cfg";s:4:"b33f";s:30:"config/tidy_default_preset.cfg";s:4:"07bd";s:26:"config/tidy_xml_preset.cfg";s:4:"e403";s:19:"doc/wizard_form.dat";s:4:"bc42";s:20:"doc/wizard_form.html";s:4:"e224";s:16:"pi1/htmLawed.php";s:4:"32c5";}',
	'suggests' => array(
	),
);

?>