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
 * Table tl_opm_offers
 */
$GLOBALS['TL_DCA']['tl_opm_offers'] = array
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
			'fields'                  => array('date'),
			'flag'                    => 11,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('no', 'date', 'tstamp'),
			'format'                  => '<strong style="text-transform:uppercase">Angebot %s</strong> vom %s<br><em>Zuletzt bearbeitet am %s Uhr</em>',
			'label_callback'          => array
			(
				'tl_opm_offers', 'setLabel'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_offers']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_offers']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_offers']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_offers']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'print' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_offers']['print'],
				'href'                => 'key=print',
				'icon'                => 'assets/contao/images/print.gif',
				'button_callback'     => array('tl_opm_offers', 'printBill')
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
		'__selector__'                => array(),
		'default'                     => '{date_legend},no,date;{content_legend},'
	),

	// Subpalettes
	'subpalettes' => array(),

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
		'locked' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_opm_labels']['locked'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'clr m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'no' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_opm_labels']['no'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'inputType'               => 'text',
			'default'                 => '201409A0001',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'disabled'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_opm_offers']['date'],
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 5,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'datepicker'=>true, 'tl_class'=>'clr w50 wizard'),
			'sql'                     => "varchar(10) NOT NULL default ''"
		)
	)
);

class tl_opm_offers extends Backend
{
	public function setLabel($arrRow, $strLabel, DataContainer $dc, $args)
	{
		$args[2] = \Date::parse('l, j. F Y, H:i', $arrRow['tstamp']);

		return vsprintf($GLOBALS['TL_DCA']['tl_opm_offers']['list']['label']['format'], $args);
	}

	public function printBill($arrRow, $strHref, $strLabel, $strTitle, $strIcon)
	{
		$strReturn = '<a href="'.$this->addToUrl($strHref.'&amp;id='.$arrRow['id']).'" target="_blank" title="'.specialchars($strTitle).'">'.Image::getHtml($strIcon, $strLabel).'</a> ';

		if (\Input::get('key') == 'print' && \Input::get('id'))
		{
			$objCorrespondence = \KdCorrespondenceModel::findOneBy('id', \Input::get('id'));
			if (is_null($objCorrespondence))
			{
				return $strReturn;
			}
			$arrRow = $objCorrespondence->row();

			require_once TL_ROOT . '/system/modules/kd/plugins/mpdf-5.7.3/mpdf.php';

			\System::loadLanguageFile('tl_opm_correspondence');

			$blnDebug = false;
			$strTitle = strip_tags($arrRow['title']);
			$strCharset = \Config::get('characterSet') ?: 'utf-8';

			// Create template object
			$objTemplate = new \BackendTemplate('pdf_correspondence');
			$objTemplate->setData($arrRow);
			$objTemplate->debug = $blnDebug;
			$objTemplate->charset = $strCharset;
			$objTemplate->date = 'Dresden, den ' . \Date::parse('d. F Y', $arrRow['date']);
			$objTemplate->customer = (object) \MemberModel::findOneBy('id', $arrRow['customer']);

			// Prepare elements
			$strElements = '';
			$objElements = \ContentModel::findPublishedByPidAndTable($arrRow['id'], 'tl_opm_correspondence');
			if (!is_null($objElements))
			{
				while ($objElements->next())
				{
					$strElements.= $this->getContentElement($objElements->id);
				}
			}
			$objTemplate->content = preg_replace_callback(
				'/(<h2)+( class=")*/i',
				function($arrResults) {
					return $arrResults[1] . ' class="first-of-type' . ($arrResults[2] ? ' ' : '"');
				},
				$strElements,
				1
			);

			// Render template
			$strTemplate = $this->replaceInsertTags($objTemplate->parse());
			$strTemplate = html_entity_decode($strTemplate, ENT_QUOTES, $strCharset);
			//exit($strTemplate);

			// Create new PDF document
			$objMpdf = new \mPDF('', strtoupper($arrRow['format']), 12, 'opensanscondensed', 25, 25, 50, 70, 0, 0, 'P');
			$objMpdf->allow_charset_conversion = true;
			$objMpdf->list_indent_first_level = true;
			$objMpdf->charset_in = $strCharset;
			$objMpdf->SetDisplayMode('fullpage');
			$objMpdf->SetImportUse();
			$objMpdf->SetDocTemplate(TL_ROOT . '/system/modules/kd/assets/pdf/' . $arrRow['format'] . ($blnDebug ? '_debug' : '') . '.pdf', true);
			$objMpdf->WriteHTML($strTemplate);
			$objMpdf->Output();

			exit;
		}

		return $strReturn;
	}
}
