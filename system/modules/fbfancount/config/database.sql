-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

-- 
-- Table `tl_fbfancount_cache`
-- 

CREATE TABLE `tl_fbfancount_cache` (
  `pageID` varchar(255) NOT NULL default '',
  `pageURL` varchar(255) NOT NULL default '',
  `fanCount` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`pageID`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `fbfc_page_url` varchar(255) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------