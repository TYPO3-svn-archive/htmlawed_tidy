
<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Nicolas Liaudat (nliaudat [at]pompiers-chatel.ch)
*  All rights reserved
*  Base inspired from "tstidy" extension from Mads Brunn
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/


class user_tidyHTML extends tslib_fe { 

    function user_contentPostProc_all(&$params, &$reference){
    	$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['htmlawed_tidy']);
        $params['pObj']->content = $this->tidy($params['pObj']->content,$confArr);
    }
    function user_contentPostProc_output(&$params, &$reference){
    	$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['htmlawed_tidy']);
        $params['pObj']->content = $this->tidy($params['pObj']->content,$confArr);
    }
    function user_contentPostProc_cached(&$params, &$reference){
    	$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['htmlawed_tidy']);
        $params['pObj']->content = $this->tidy($params['pObj']->content,$confArr);
    }
    
    function tidy($content, $confArr) {
	
	//parse the configuration  and dispatch it: 
	//$generalConf = array ();
	$tidyConf = array (); 
	$htmlawedConf = array ();
		
		foreach ($confArr as $key => $val) {
			
			//if(substr($key, 0, 6) == 'GeOpt_'){
			//	$generalConf[substr($key,2)] = $val;
			//}
			
			if(substr($key, 0, 6) == 'TdOpt_'){
				$tidyConf[substr($key,6)] = $val;
			}
			
			if(substr($key, 0, 6) == 'HlOpt_'){
				$htmlawedConf[substr($key,6)] = $val;
			}
			
		}
	
    
	$debug = $confArr['debug'];    
    	$mode = $confArr['mode'];  
    	   	if(!isset($mode)){$mode = 'htmlawed';} // htmlawed, tidy (php5 if available), php5tidy, typo3_tidy
    	
    	
    	
    	$oldContent = $content;
    	
    	if($mode == 'tidy' && phpversion() > '5.0.0' || $mode == 'php5tidy'){
			//################ PHP5 tidy way
			// http://tidy.sourceforge.net/
				if($debug == true) {$time_start = microtime(true);}
				
				$encoding = $confArr['encoding'];
				

/*				
				$tidyConf = array('indent' => TRUE,
						'hide-comments' => TRUE,
						'clean' => TRUE,
                		'output-xhtml' => TRUE,
					    'input-xml'     => true,
            			'wrap'         => '1000');
*/

				if($confArr['tidy_preset'] != 'none'){ //load preset configuration
					//tidy accept file as config
					$tidyConf = t3lib_extMgm::extPath ("htmlawed_tidy")."config/" .$confArr['tidy_preset'];
				}

                $tidy = tidy_parse_string($oldContent , $tidyConf, $encoding);
                $tidy->cleanRepair();

				$content = $tidy;
				unset($tidy);
				
				//$content = $content .'<!-- DEBUG tidyConf' . var_dump($tidyConf) .' -->';

		}elseif($mode == 'tidy' && phpversion() < '5.0.0' || $mode == 'typo3_tidy'){ 
			//##############
			// PHP lower than 5.0 - original Typo3 way
			
				if($debug == true) {$time_start = microtime(true);}
				$content = parent::tidyHTML($oldContent); //process with original function from tslib_fe
				
		}elseif($mode == 'DOMDocument'){
		
				if($debug == true) {$time_start = microtime(true);}
				
				// load our document into a DOM object
				$dom = @DOMDocument::loadHTML($oldContent);
				// we want nice output
				$dom->formatOutput = true;
				$content = $dom->saveHTML());
				unset($dom);
		
		}elseif($mode == 'htmlawed'){
		
				require_once (t3lib_extMgm::extPath ("htmlawed_tidy")."pi1/htmLawed.php");
/*				
				$htmlawedConf = array('comment'=>1,
								'cdata'=>1); 
*/
				if($confArr['htmlawed_preset'] != 'none'){ //load preset configuration
					$htmlawedConf = parse_ini_file(t3lib_extMgm::extPath ("htmlawed_tidy")."config/" .$confArr['htmlawed_preset']);	
				}
				

				if($debug == true) {$time_start = microtime(true);}
				$content = htmLawed($oldContent, $htmlawedConf);
				
				//$content = $content .'<!-- DEBUG htmlawedConf' . var_dump($htmlawedConf) .' -->';
				
		}else{
			$content .= "<!-- ERROR 'htmLawed_tidy' : $mode mode not correct : choose htmlawed, tidy (php5 if available), php5tidy, typo3_tidy -->";
		}


		if($debug == true) {
			$time_end = microtime(true);
			$time = $time_end - $time_start;
			$time *= 1000000;
			$ratio = intval(((strlen($oldContent) - strlen($content)) / strlen($oldContent)) *100) ;
			$content .= "<!-- DEBUG 'htmLawed_tidy' : $mode function parsed in $time  microsecond  / compression rate : $ratio percent  -->" ;
		}

		unset($oldContent);
		return $content;    
		}



	
}//end class

if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/htmlawed_tidy/class.user_tidyHTML.php"])    {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/htmlawed_tidy/class.user_tidyHTML.php"]);
}

?>

