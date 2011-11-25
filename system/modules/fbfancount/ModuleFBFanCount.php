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


class ModuleFBFanCount extends Module {


	protected $strTemplate = 'mod_fbfc_show';


    public function __construct( $oDB ) {
    
        parent::__construct($oDB);
    }


	/**
	 * Generate module
	 */
	protected function compile() {
	
        $this->Template = new FrontendTemplate($this->strTemplate);
		
		$oPageData = $this->Database->prepare(" SELECT * FROM `tl_fbfancount_cache` WHERE `pageID` = ?; ")->execute($this->fbfc_page_url);
		
		$aPageData = array();
		$aPageData = $oPageData->fetchAssoc();
		
		#echo '<pre>'.print_r($aPageData,1).'</pre>';
		
		$this->Template->url = $aPageData['pageURL'];
		$this->Template->count = $aPageData['fanCount'];

	}
}
?>