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

class ContentSubtotal extends \develab\accounting\Elements\ContentTotal
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_accounting_subtotal';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		$objElements = \Contao\ContentModel::findBy(array('id!=? AND pid=? AND ptable=? AND type=? AND sorting<=?'), array($this->id, $this->pid, $this->ptable, 'accounting_item', $this->sorting));
		$objPrice = \develab\accounting\Helper::getTotalPrice($objElements);

		$this->Template->price = \develab\accounting\Helper::formatPrice($objPrice->price);
		$this->Template->taxes = $objPrice->taxes;
		$this->Template->quantities = $objPrice->quantities;
		$this->Template->price_total = \develab\accounting\Helper::formatPrice($objPrice->total);
		$this->Template->currency = \develab\accounting\Helper::getCurrency();
	}
}
