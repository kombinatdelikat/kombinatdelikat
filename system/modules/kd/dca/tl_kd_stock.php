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


/**
 * Table tl_kd_stock
 */
$GLOBALS['TL_DCA']['tl_kd_stock'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'onload_callback'             => array
		(
			array('KdHelper', 'showStockMessage')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('date'),
			'flag'                    => 8
		),
		'label' => array
		(
			'fields'                  => array('icon', 'date', 'type', 'quantity', 'product'),
			'showColumns'             => true,
			'label_callback'          => array
			(
				'tl_kd_stock', 'setLabel'
			)
		),
/*
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
*/
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_stock']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_stock']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_stock']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Select
	'select' => array
	(
		'buttons_callback' => array()
	),

	// Edit
	'edit' => array
	(
		'buttons_callback' => array()
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('type'),
		'default'                     => '{type_legend},type;',
		'incoming'                    => '{type_legend},type,date;{product_legend},charge;',
		'outgoing'                    => '{type_legend},type,date;{product_legend},charge,quantity,related_order;{contact_legend},customer,custodian;',
		'order'                       => '{type_legend},type,date;{product_legend},product,quantity,delivery,disabled;{contact_legend},customer,custodian;'
	),

	// Subpalettes
	'subpalettes' => array
	(
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'type' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['type'],
			'default'                 => 'order',
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_kd_stock', 'generateStockTypes'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_kd_stock']['types'],
			'eval'                    => array('helpwizard'=>true, 'chosen'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['date'],
			'inputType'               => 'text',
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'eval'                    => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'charge' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['charge'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_kd_product_charges.number',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'eager'),
			'options_callback'        => array('tl_kd_stock', 'groupCharges'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'product' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['product'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_kd_products.title',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'eager'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'quantity' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['quantity'],
			'exclude'                 => true,
			'inputType'               => 'text',
/*
			'load_callback' => array
			(
				array('tl_kd_stock', 'verifyQuantity')
			),
*/
			'save_callback' => array
			(
				array('tl_kd_stock', 'verifyQuantity')
			),
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'doNotCopy'=>true, 'tl_class'=>'w50'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'related_order' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['related_order'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_stock.title',
			'eval'                    => array('chosen'=>false, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'options_callback'        => array('tl_kd_stock', 'getRelatedOrder'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'delivery' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['delivery'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'load_callback' => array
			(
				array('tl_kd_stock', 'generateDeliveryDate')
			),
			'save_callback' => array
			(
				array('tl_kd_stock', 'generateDeliveryDate')
			),
			'eval'                    => array('rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'clr w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'disabled' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['disabled'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'customer' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['customer'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.id',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'options_callback'        => array('tl_kd_stock', 'getContacts'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'custodian' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_stock']['custodian'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.id',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'options_callback'        => array('tl_kd_stock', 'getContacts'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
	)
);

class tl_kd_stock extends Backend
{
	public function setLabel($row, $label, DataContainer $dc, $args)
	{
		switch ($row['type'])
		{
			case 'incoming':
				$image = 'copy';
				$objCharge = \KdProductChargesModel::findByPk($row['charge']);
				$objProduct = $objCharge->getRelated('pid');
				if (!is_null($objCharge))
				{
					$args[3] = $objCharge->quantity;
					$args[4] = sprintf('%s (%s)', $objProduct->title, $objCharge->number);
				}
				break;

			case 'outgoing':
				$image = 'delete';
				$objCharge = \KdProductChargesModel::findByPk($row['charge']);
				if (!is_null($objCharge))
				{
					$objProduct = $objCharge->getRelated('pid');
					$args[4] = sprintf('%s (%s)', $objProduct->title, $objCharge->number);
				}
				$args[3] = '-' . $row['quantity'];
				break;

			case 'order':
				$image = 'delete_';
				$strFormat = $row['delivery'] < time() ? '<s>%s</s>' : '%s';
				$args[3] = sprintf('(%s)', $row['quantity']);
				$args[4] = sprintf($strFormat, \KdProductsModel::findByPk($row['product'])->title);
				break;

			default:
				return;
		}

		$args[0] = sprintf('<div class="list_icon_new" style="background-image:url(\'%ssystem/themes/%s/images/%s.gif\')">&nbsp;</div>', TL_ASSETS_URL, Backend::getTheme(), $image);

		return $args;
	}

	public function getContacts()
	{
		$arrContacts = array();
		$objContacts = \MemberModel::findAll(array('order' => 'lastname'));

		if (is_null($objContacts))
		{
			return $arrContacts;
		}

		while ($objContacts->next())
		{
			$strGroups = '';
			$arrGroups = array();
			$objGroups = \MemberGroupModel::findMultipleByIds(deserialize($objContacts->groups, true));

			if (!is_null($objGroups))
			{
				while ($objGroups->next())
				{
					$arrGroups[$objGroups->name] = $objGroups->name;
				}
				ksort($arrGroups);
				$strGroups = ' (' . implode(', ', $arrGroups) . ')';
			}

			$arrContacts[$objContacts->id] = $objContacts->firstname . ' ' . $objContacts->lastname . ', ' . $objContacts->company . $strGroups;
		}

		return $arrContacts;
	}

	public function getRelatedOrder()
	{
		$arrRelatedOrders = array();
		$objRelatedOrders = \KdStockModel::findBy('type', 'order');

		if (!is_null($objRelatedOrders))
		{
			while ($objRelatedOrders->next())
			{
				$arrRelatedOrders[$objRelatedOrders->id] = $objRelatedOrders->date;
			}
		}

		return $arrRelatedOrders;
	}

	public function groupCharges()
	{
		$arrProducts = array();
		$objProducts = \KdProductsModel::findAll();

		if (is_null($objProducts))
		{
			return $arrProducts;
		}

		while ($objProducts->next())
		{
			$objProductCharges = \KdProductChargesModel::findBy('pid', $objProducts->id);

			if (!is_null($objProductCharges))
			{
				//$return[$objLayout->theme][$objLayout->id] = $objLayout->name;

				while ($objProductCharges->next())
				{
					$arrProducts[$objProducts->title][$objProductCharges->id] = $objProductCharges->number;
				}
			}
		}

		ksort($arrProducts);

		return $arrProducts;
	}

	public function generateStockTypes(DataContainer $dc)
	{
		$intAvail = \KdStockModel::getQuantity(null, $dc->activeRecord->id);
		$arrTypes = array('incoming', 'order');

		if ($intAvail) {
			array_push($arrTypes, 'outgoing');
		}

		return $arrTypes;
	}

	public function verifyQuantity($varValue, DataContainer $dc)
	{
		if ($varValue == '' || $varValue <= 0) {
			$varValue = 1;
		}

/*
		$intMax = \KdStockModel::getQuantityByFormula($dc->activeRecord->formula, $dc->activeRecord->id, $dc->activeRecord->date);

		if ($varValue > $intMax) {
			$varValue = $intMax;
		}
*/

		return $varValue;
	}

	public function generateDeliveryDate($varValue, DataContainer $dc)
	{
		if ($dc->activeRecord->type != 'order') {
			return $varValue;
		}
		if ($varValue == '' || $varValue < $dc->activeRecord->date) {
			$varValue = $dc->activeRecord->date;
		}
		return $varValue;
	}
}
