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
 * Load tl_content language file
 */
System::loadLanguageFile('tl_content');


/**
 * Table tl_opm_correspondence
 */
$GLOBALS['TL_DCA']['tl_opm_correspondence'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ctable'                      => array('tl_content'),
		'switchToEdit'                => true,
		'enableVersioning'            => true,
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
			'panelLayout'             => 'filter;sort,search,limit',
			'child_record_class'      => 'no_padding'
		),
		'label' => array
		(
			'fields'                  => array('title', 'format', 'date', 'customer', 'tstamp'),
			'format'                  => '<strong>%s</strong> (%s)<span style="display:block;width:250px;margin:5px 0;padding:5px;border:1px solid #ccc;font-family:Courier;text-transform:uppercase">%s<br>%s</span><em>Zuletzt bearbeitet am %s Uhr</em>',
			'label_callback'          => array
			(
				'tl_opm_correspondence', 'setLabel'
			)
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['edit'],
				'href'                => 'table=tl_content',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			),
			'print' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['print'],
				'href'                => 'key=print',
				'icon'                => 'assets/contao/images/print.gif',
				'button_callback'     => array('tl_opm_correspondence', 'printCorrespondence')
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(),
		'default'                     => '{title_legend},title,format;{content_legend},date,customer'
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
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'format' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['format'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'inputType'               => 'select',
			'default'                 => 'a4',
			'options'                 => array('a4'=>'A4', 'a5'=>'A5'),
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50', 'chosen'=>true),
			'sql'                     => "varchar(10) NOT NULL default ''"
		),
		'date' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['date'],
			'default'                 => time(),
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 8,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'date', 'doNotCopy'=>true, 'datepicker'=>true, 'tl_class'=>'clr w50 wizard'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'customer' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_opm_correspondence']['customer'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'foreignKey'              => 'tl_member.id',
			'eval'                    => array('mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>false, 'tl_class'=>'w50'),
			'relation'                => array('type'=>'hasOne', 'load'=>'lazy'),
			'options_callback'        => array('\develab\opm\Helper', 'getContacts'),
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		)
	)
);

class tl_opm_correspondence extends Backend
{
	public function setLabel($arrRow, $strLabel, DataContainer $dc, $args)
	{
		$args[0] = $this->replaceInsertTags($arrRow['title']);
		$args[2] = 'Dresden, den ' . \Date::parse('d. F Y', $arrRow['date']);
		$args[3] = '';
		$args[4] = \Date::parse('l, j. F Y, H:i', $arrRow['tstamp']);

		$objCustomer = \MemberModel::findOneBy('id', $arrRow['customer']);
		if (!is_null($objCustomer))
		{
			$args[3].= $objCustomer->company ? '<strong>' . $objCustomer->company . '</strong>' : '';
			$args[3].= '<br>' . (!$objCustomer->company ? '<strong>' : '') . $objCustomer->firstname . ' ' . $objCustomer->lastname . (!$objCustomer->company ? '</strong>' : '');
			$args[3].= '<br>' . $objCustomer->street;
			$args[3].= '<br>' . strtoupper($objCustomer->country ?: 'de') . '-' . $objCustomer->postal . ' ' . $objCustomer->city;
		}

		return vsprintf($GLOBALS['TL_DCA']['tl_opm_correspondence']['list']['label']['format'], $args);
	}

	public function printCorrespondence($arrRow, $strHref, $strLabel, $strTitle, $strIcon)
	{
		$strReturn = '<a href="'.$this->addToUrl($strHref.'&amp;id='.$arrRow['id']).'" target="_blank" title="'.specialchars($strTitle).'">'.Image::getHtml($strIcon, $strLabel).'</a> ';

		if (\Input::get('key') == 'print' && \Input::get('id'))
		{
			$objCorrespondence = \develab\opm\Models\Correspondence::findOneBy('id', \Input::get('id'));
			if (is_null($objCorrespondence))
			{
				return $strReturn;
			}
			$arrRow = $objCorrespondence->row();

			require_once TL_ROOT . '/system/modules/opm/vendor/mpdf-5.7.3/mpdf.php';

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
