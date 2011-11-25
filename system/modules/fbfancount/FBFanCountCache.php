<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  numero2 - Agentur für Internetdienstleistungen <www.numero2.de>
 * @author     Benny Born <benny.born@numero2.de>
 * @package    FBFanCount
 * @license    LGPL
 * @filesource
 */
 
 
class FBFanCountCache extends Frontend {


	public function update() {
	
		$oPageURLs = $this->Database->prepare(" SELECT `fbfc_page_url` FROM `tl_module` WHERE `type` = 'fbfc_show'; ")->execute();

        while( $oPageURLs->next() ) {
        
		
			$sPageInfo = NULL;
			$sPageInfo = file_get_contents('http://graph.facebook.com/'.$oPageURLs->fbfc_page_url);
			
			if( !empty($sPageInfo) ) {
			
				$aPageInfo = array();
				$aPageInfo = json_decode($sPageInfo,1);
				
				if( !array_key_exists('likes',$aPageInfo) ) {
					$this->log('Could not get fancount for facebook page with ID "'.$oPageURLs->fbfc_page_url.'"', 'FBFanCountCache update()', TL_ERROR);
					continue;
				}
				
				try {
				
					$oCountUpdate = NULL;
					$oCountUpdate = $this->Database->prepare(" INSERT INTO `tl_fbfancount_cache` (`pageID`,`pageURL`,`fanCount`) VALUES (?,?,?); ")->execute($aPageInfo['id'],$aPageInfo['link'],$aPageInfo['likes']);
					
				} catch( Exception $e ) {
				
					$oCountUpdate = NULL;
					$oCountUpdate = $this->Database->prepare(" UPDATE `tl_fbfancount_cache` SET `fanCount` = ?, `pageURL` = ? WHERE `pageID` = ?; ")->execute($aPageInfo['likes'],$aPageInfo['link'],$aPageInfo['id']);
				}

				
			} else {

				$this->log('Could not get fancount for facebook page with ID "'.$oPageURLs->fbfc_page_url.'"', 'FBFanCountCache update()', TL_ERROR);
			}		
        }
	}
}

?>