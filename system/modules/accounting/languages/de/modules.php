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
 * Back end modules
 */
//$GLOBALS['TL_LANG']['MOD'][''] = array('', '');
$GLOBALS['TL_LANG']['MOD']['accounting'] = 'Buchhaltung';
$GLOBALS['TL_LANG']['MOD']['accounting_contacts'] = array('Kontakte', 'Kontakte verwalten');
$GLOBALS['TL_LANG']['MOD']['accounting_contact_groups'] = array('Kontaktgruppen', 'Kontakte in Gruppen unterteilen');
$GLOBALS['TL_LANG']['MOD']['accounting_bills'] = array('Rechnungen', 'Rechnungen erstellen und als PDF zum Druck ausgeben');
$GLOBALS['TL_LANG']['MOD']['accounting_offers'] = array('Angebote', 'Angebote schreiben und als PDF erstellen und drucken');
$GLOBALS['TL_LANG']['MOD']['accounting_correspondence'] = array('Korrespondenz', 'Anschreiben erstellen, als PDF ausgeben und drucken');
$GLOBALS['TL_LANG']['MOD']['accounting_settings'] = array('Einstellungen', 'Bearbeiten der Einstellungen');


/**
 * Front end modules
 */
//$GLOBALS['TL_LANG']['FMD'][''] = array('', '');


/**
 * Content Elements
 */
$GLOBALS['TL_LANG']['CTE']['accounting'] = 'Buchhaltungselemente';
$GLOBALS['TL_LANG']['CTE']['layout'] = 'Layout-Elemente';
$GLOBALS['TL_LANG']['CTE']['accounting_item'] = array('Position', 'Fügt einen dem Dokument eine neue Position hinzu.');
$GLOBALS['TL_LANG']['CTE']['accounting_subtotal'] = array('Zwischensumme', 'Stellt die Zwischensumme aller vorangegangener Posten (ggf. seit der letzten Zwischensumme) dar.');
$GLOBALS['TL_LANG']['CTE']['accounting_total'] = array('Summe', 'Bildet die Summe aller Posten ab. Sollte nach Möglichkeit immer am Ende eingefügt werden.');
$GLOBALS['TL_LANG']['CTE']['accounting_pdf_pb'] = array('Seitenumbruch', 'Fügt einen Seitenumbruch in die PDF-Datei ein.');