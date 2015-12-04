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
namespace develab\accounting\Models;

class CorrespondenceModel extends AccountingModel {

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_accounting_correspondence';

}
