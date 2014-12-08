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

class ContentTotal extends \Contao\ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_accounting_total';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		$objElements = \Contao\ContentModel::findBy(array('id!=? AND pid=? AND ptable=? AND type=?'), array($this->id, $this->pid, $this->ptable, 'accounting_item'));
		$objPrice = \develab\accounting\Helper::getTotalPrice($objElements);
		$arrFields = \develab\accounting\Helper::getFields($this->objParentModel, 2);

		$this->Template->fields = $arrFields;
		$this->Template->price_subtotal = \develab\accounting\Helper::formatPrice($objPrice->price);
		$this->Template->taxes = $objPrice->taxes;
		$this->Template->quantities = $objPrice->quantities;
		$this->Template->price_total = \develab\accounting\Helper::formatPrice($objPrice->total);
		$this->Template->currency = \develab\accounting\Helper::getCurrency();
	}
}
