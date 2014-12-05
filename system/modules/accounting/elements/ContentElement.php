<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package   accounting
 * @author    David Enke <post@davidenke.de>
 * @license   EULA
 * @copyright David Enke 2014
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting\Elements;

abstract class ContentElement extends \Contao\ContentElement
{
	protected function getCurrency()
	{
		$strReturn = 'Euro';
		$arrCurrency = deserialize(\Config::get('accounting_currency'), true);

		if (sizeof($arrCurrency) > 1)
		{
			$strReturn = $arrCurrency[1];
		}

		return $strReturn;
	}
}
