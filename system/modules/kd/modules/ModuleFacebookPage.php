<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   KombinatDelikat
 * @author    David Enke <post@davidenke.de>
 * @license   EULA
 * @copyright David Enke 2014
 */

namespace KombinatDelikat\Modules;


/**
 * Front end module "facebook page".
 *
 * @author    David Enke <post@davidenke.de>
 */
class ModuleFacebookPage extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_facebook_page';


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$arrElements = array();

		\FacebookSession::setDefaultApplication($this->fb_app_id, $this->fb_app_secret);
		$objSession = \FacebookSession::newAppSession();

		if ($objSession->validate())
		{
			$objFacebookPage = (new \FacebookRequest($objSession, 'GET', '/' . $this->fb_page_id))->execute()->getGraphObject(\GraphUser::className());
			$objFacebookPosts = (new \FacebookRequest($objSession, 'GET', '/' . $this->fb_page_id . '/posts'))->execute()->getGraphObject(\GraphUser::className());

			print_r($objFacebookPage);
		}

		$this->Template->elements = $arrElements;
	}
}
