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

abstract class ContentAccounting extends \Contao\ContentElement
{

	protected $strTemplate;
	protected $objParentModel;

	/**
	 * Generate the content element
	 */
	public function generate()
	{
		$strClass = $GLOBALS['TL_MODELS'][$this->objModel->ptable];
		$this->objParentModel = $strClass::findOneBy('id', $this->objModel->pid);

		return parent::generate();
	}

	/**
	 * Compile the content element
	 */
	protected function compile()
	{
		$this->Template->fields = $this->objParentModel->getFields($this->indent ?: 0, $this->fields);
		$this->Template->currency = \develab\accounting\Helper::getCurrency();
		$this->Template->position = $this->position;
	}
}
