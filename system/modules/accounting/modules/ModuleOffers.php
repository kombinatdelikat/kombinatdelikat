<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting\Modules;

class ModuleOffers extends \develab\accounting\Modules\ModuleAccounting
{
	protected $strType = 'offers';
	protected $strTemplate = 'pdf_accounting_offers';
}
