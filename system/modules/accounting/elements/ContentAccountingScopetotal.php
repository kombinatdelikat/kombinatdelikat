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

class ContentAccountingScopetotal extends ContentAccounting
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_accounting_scopetotal';


	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		parent::compile();

		$arrElements = array();
		$arrElementTypes = array_keys($GLOBALS['TL_CTE_' . strtoupper(str_replace('tl_accounting_', '', $this->ptable))]['accounting']);
		$intIndent = isset($this->indent) ? $this->indent : 2;

		$objElementsUp = \Contao\ContentModel::findBy(
			array('id!=? AND pid=? AND ptable=? AND sorting>=?'),
			array($this->id, $this->pid, $this->ptable, $this->sorting),
			array('order'=>'sorting ASC')
		);
		$objElementsDown = \Contao\ContentModel::findBy(
			array('id!=? AND pid=? AND ptable=? AND sorting<=?'),
			array($this->id, $this->pid, $this->ptable, $this->sorting),
			array('order'=>'sorting DESC')
		);

		if (!is_null($objElementsUp))
		{
			foreach ($objElementsUp as $objElementUp)
			{
				if (!in_array($objElementUp->type, $arrElementTypes))
				{
					break;
				}
				if ($objElementUp->type == 'accounting_item')
				{
					$arrElements[] = $objElementUp;
				}
			}
		}

		if (!is_null($objElementsDown))
		{
			foreach ($objElementsDown as $objElementDown)
			{
				if (!in_array($objElementDown->type, $arrElementTypes))
				{
					break;
				}
				if ($objElementDown->type == 'accounting_item')
				{
					$arrElements[] = $objElementDown;
				}
			}
		}

		$objPrice = \develab\accounting\Helper::getTotalPrice($arrElements);
		$arrFields = $this->objParentModel->getFields($intIndent, $this->fields);

		$this->Template->indent = $intIndent;
		$this->Template->fields = $arrFields;
		$this->Template->price_subtotal = \develab\accounting\Helper::formatPrice($objPrice->price);
		$this->Template->taxes = $objPrice->taxes;
		$this->Template->quantities = $objPrice->quantities;
		$this->Template->price_total = \develab\accounting\Helper::formatPrice($objPrice->total);
	}
}
