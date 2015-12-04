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
$GLOBALS['TL_LANG']['MOD']['accounting_settings_general'] = 'Allgemeine Einstellungen';
$GLOBALS['TL_LANG']['MOD']['accounting_settings_format'] = array('Automatische Nummerierung', 'Verwaltet die fortlaufenden Nummern, deren Formatierung und Gültigkeiten');
$GLOBALS['TL_LANG']['MOD']['accounting_settings_units'] = array('Einheiten und Kategorien', 'Speichert die Vorlagen für Einheiten und Kategorien');
$GLOBALS['TL_LANG']['MOD']['accounting_settings_layouts'] = array('Vorlagen und Speicherorte', 'Verwaltet die Layouts zur Dokumentenerzeugung');
$GLOBALS['TL_LANG']['MOD']['accounting_settings_defaults'] = array('Standardzuweisungen', 'Ermöglicht die Zuordnung standardisierter Einstellungen');


/**
 * Content Elements
 */
$GLOBALS['TL_LANG']['CTE']['accounting'] = 'Buchhaltungselemente';
$GLOBALS['TL_LANG']['CTE']['layout'] = 'Layout-Elemente';
$GLOBALS['TL_LANG']['CTE']['accounting_item'] = array('Position', 'Fügt einen dem Dokument eine neue Position hinzu.');
$GLOBALS['TL_LANG']['CTE']['accounting_overview'] = array('Übersicht', 'Stellt eine tabellarische Übersicht der Posten nach Kategorie bereit.');
$GLOBALS['TL_LANG']['CTE']['accounting_scopesubtotal'] = array('Zwischensumme Bereich', 'Stellt die Zwischensumme aller <strong>vorangegangener</strong> Posten des <strong>Bereiches (zusammenhängende Positionen)</strong> dar.');
$GLOBALS['TL_LANG']['CTE']['accounting_scopetotal'] = array('Bereichssumme', 'Stellt die Gesamtsumme aller Posten des <strong>Bereiches (zusammenhängende Positionen)</strong> dar.');
$GLOBALS['TL_LANG']['CTE']['accounting_subtotal'] = array('Zwischensumme Gesamt', 'Stellt die Zwischensumme aller <strong>vorangegangener</strong> Posten der Rechnung dar.');
$GLOBALS['TL_LANG']['CTE']['accounting_total'] = array('Gesamtsumme', 'Bildet die Summe aller Posten der Rechnung ab.');
$GLOBALS['TL_LANG']['CTE']['accounting_pdf_pb'] = array('Seitenumbruch', 'Fügt einen Seitenumbruch in die PDF-Datei ein.');
