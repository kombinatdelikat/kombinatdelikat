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
 * Table tl_kd_labels
 */
$GLOBALS['TL_DCA']['tl_kd_labels'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'onload_callback'             => array
		(
//			array('KdHelper', 'showStockMessage')
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
			'mode'                    => 2,
			'fields'                  => array('title'),
			'flag'                    => 11,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('title', 'charge', 'date_prod', 'tstamp'),
			'format'                  => '<span style="text-transform:uppercase">%s</span> (%s)<br>Produziert am %s<br><em>Zuletzt bearbeitet am %s Uhr</em>',
			'label_callback'          => array
			(
				'tl_kd_labels', 'setLabel'
			),
			'group_callback'          => array
			(
				'tl_kd_labels', 'setGroup'
			)
		),
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
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_labels']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_labels']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_labels']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_labels']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'print' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_kd_labels']['print'],
				'href'                => 'key=print',
				'icon'                => 'assets/contao/images/print.gif',
				'button_callback'     => array('tl_kd_labels', 'printLabels')
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
		'__selector__'                => array('add_deep'),
		'default'                     => '{title_legend},title,charge,ingredients;{date_legend},date_prod,date_exp,add_deep;{content_legend},prices;{template_legend},offset,debug'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'add_deep'                            => 'date_deep'
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
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'charge' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['charge'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>128, 'rgxp'=>'alnum', 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'ingredients' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['ingredients'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('mandatory'=>true, 'style'=>'min-height:60px', 'tl_class'=>'clr'),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
		),
		'date_prod' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['date_prod'],
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 5,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'clr w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'date_exp' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['date_exp'],
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 5,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'add_deep' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['add_deep'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'clr m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'date_deep' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['date_deep'],
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 5,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'clr w50'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'prices' => array
		(
			'exclude'                 => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['prices'],
			'inputType'               => 'multiColumnWizard',
			'eval'                    => array
			(
				'tl_class' => 'clr',
				'minCount' => 1,
//				'maxCount' => 14,
				'buttons' => array
				(
					'up' => false,
					'down' => false
				),
				'columnFields' => array
				(
					'price' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_kd_labels']['price'],
						'exclude'       => true,
						'inputType'     => 'text',
						'eval'          => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>11)
					),
					'weight' => array
					(
						'label'         => &$GLOBALS['TL_LANG']['tl_kd_labels']['weight'],
						'exclude'       => true,
						'inputType'     => 'text',
						'eval'          => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>11)
					)
				)
			),
			'sql'                     => "blob NULL"
		),
		'offset' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['offset'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array(1,2,3,4,5,6,7,8,9,10,11,12,13,14),
			'sql'                     => "varchar(10) NOT NULL default '0'"
		),
		'debug' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_kd_labels']['debug'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'clr m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);

class tl_kd_labels extends Backend
{
	public function setLabel($arrRow, $strLabel, DataContainer $dc, $args)
	{
		$args[0] = $this->replaceInsertTags($arrRow['title']);
		$args[2] = \Date::parse('l, j. F Y', $arrRow['date_prod']);
		$args[3] = \Date::parse('l, j. F Y, H:i', $arrRow['tstamp']);

		return vsprintf($GLOBALS['TL_DCA']['tl_kd_labels']['list']['label']['format'], $args);
	}

	public function setGroup($strLabel, $intFlag, $strField, $arrRow, $dc)
	{
		if ($strField == 'charge')
		{
			$GLOBALS['TL_DCA']['tl_kd_labels']['list']['sorting']['disableGrouping'] = true;
			return sprintf($GLOBALS['TL_LANG']['MSC']['list_orderBy'], $GLOBALS['TL_LANG']['tl_kd_labels']['charge'][0]);
		}
		elseif ($strField == 'title')
		{
			return $this->replaceInsertTags($strLabel);
		}
		return $strLabel;
	}

	public function printLabels($arrRow, $strHref, $strLabel, $strTitle, $strIcon)
	{
		$strReturn = '<a href="'.$this->addToUrl($strHref.'&amp;id='.$arrRow['id']).'" target="_blank" title="'.specialchars($strTitle).'">'.Image::getHtml($strIcon, $strLabel).'</a> ';

		if (\Input::get('key') == 'print' && \Input::get('id'))
		{
			$objLabels = \KdLabelsModel::findOneBy('id', \Input::get('id'));
			if (is_null($objLabels))
			{
				return $strReturn;
			}
			$arrRow = $objLabels->row();

			require_once TL_ROOT . '/system/modules/kd/plugins/mpdf-5.7.3/mpdf.php';

			\System::loadLanguageFile('tl_kd_labels');

			$blnDebug = false;
			$strTitle = strip_tags($arrRow['title']);
			$strCharset = \Config::get('characterSet') ?: 'utf-8';

			// Create template object
			$objTemplate = new \BackendTemplate('pdf_labels');
			$objTemplate->setData($arrRow);
			$objTemplate->debug = $arrRow['debug'];
			$objTemplate->charset = $strCharset;
			$objTemplate->cols = 2;
			$objTemplate->rows = 7;
			$objTemplate->date_prod = \Date::parse('d.m.Y', $arrRow['date_prod']);
			$objTemplate->date_exp = \Date::parse('d.m.Y', $arrRow['date_exp']);
			$objTemplate->date_deep = \Date::parse('d.m.Y', $arrRow['date_deep']);

			// Prepare prices
			$arrLabels = deserialize($arrRow['prices'], true);
			foreach ($arrLabels as $k=>$arrLabel)
			{
				$intPrice = round(floatval($arrLabel['price']), 2);
				$intWeight = round(floatval($arrLabel['weight']), 3);
				$intPriceNet = $intPrice * $intWeight;
				$intPriceBrut = $intPriceNet * 1.07;

				$arrLabel['price'] = number_format($intPrice, 2, ',', '.');
				$arrLabel['weight'] = number_format($intWeight, 3, ',', '.');
				$arrLabel['price_net'] = number_format($intPriceNet, 2, ',', '.');
				$arrLabel['price_brut'] = number_format($intPriceBrut, 2, ',', '.');

				$arrLabels[$k] = $arrLabel;
			}
			$objTemplate->labels = array_merge($arrRow['offset'] > 1 ? range(0, $arrRow['offset']-2) : array(), $arrLabels);
			$objTemplate->lines = ceil(sizeof($objTemplate->labels) / $objTemplate->cols);
			$objTemplate->pages = ceil($objTemplate->lines / ($objTemplate->cols * $objTemplate->rows));
			$objTemplate->per_page = $objTemplate->rows * $objTemplate->cols;

			// Render template
			$strTemplate = $this->replaceInsertTags($objTemplate->parse());
			$strTemplate = html_entity_decode($strTemplate, ENT_QUOTES, $strCharset);
			//exit($strTemplate);

			// Create new PDF document
			$objMpdf = new \mPDF('', 'A4', 10, 'opensanscondensed', 0, 0, 0, 0, 0, 0, 'P');
			$objMpdf->allow_charset_conversion = true;
			$objMpdf->charset_in = $strCharset;
			$objMpdf->SetDisplayMode('fullpage');
			if ($blnDebug)
			{
				$objMpdf->SetImportUse();
				$objMpdf->SetDocTemplate(TL_ROOT . '/system/modules/kd/assets/pdf/labels_debug.pdf', true);
			}
			$objMpdf->WriteHTML($strTemplate);
			$objMpdf->Output();

			exit;
		}

		return $strReturn;
	}
}
