<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting\Modules;

class ModuleCorrespondence extends \develab\accounting\Modules\ModuleAccounting
{
	protected $strType = 'correspondence';
	protected $strTemplate = 'pdf_accounting_correspondence';
}
