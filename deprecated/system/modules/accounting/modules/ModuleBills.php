<?php

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace develab\accounting\Modules;

class ModuleBills extends \develab\accounting\Modules\ModuleAccounting
{
	protected $strType = 'bills';
	protected $strTemplate = 'pdf_accounting_bills';
}
