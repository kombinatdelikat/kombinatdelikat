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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_accounting_settings']['edit_locked'] = array('Geschützte Dokumente editierbar?', 'Geben Sie an, ob bereits generierte Dokumente nachträglich entsperrt und bearbeitet werden dürfen.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['no_bills_current'] = array('Aktuelle Rechnungsnummer', 'Die aktuelle Zahl der fortlaufenden Rechnungsnummer.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['no_offers_current'] = array('Aktuelle Angebotsnummer', 'Die aktuelle Zahl der fortlaufenden Angebotsnummer.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['no_bills_pattern'] = array('Formatierung der Rechnungsnummer', 'Die Aufbau der zu vergebenden Rechnungsnummer.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['no_offers_pattern'] = array('Formatierung der Angebotsnummer', 'Die Aufbau der zu vergebenden Angebotsnummer.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['due_bills'] = array('Fälligkeit Rechnungen', 'Die Anzahl an Tagen bis zur Fälligkeit der Rechnung.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['due_offers'] = array('Gültigkeit Angebote', 'Die Anzahl an Tagen der Gültigkeit des Angebots.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['tpl_bills'] = array('Rechnungshintergrund fortlaufend', 'Geben Sie eine PDF-Datei zur Darstellung im Hintergrund der Rechnung an. Die letzte Seite wird fortlaufend wiederholt.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['tpl_offers'] = array('Angebotshintergrund fortlaufend', 'Geben Sie eine PDF-Datei zur fortlaufenden Darstellung im Hintergrund des Angebots an.. Die letzte Seite wird fortlaufend wiederholt.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['css_bills'] = array('Rechnungs-Stylesheet', 'Geben Sie eine CSS-Datei zur Formatierung der Rechnung an.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['css_offers'] = array('Angebots-Stylesheet', 'Geben Sie eine CSS-Datei zur Formatierung des Angebots an.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['fields_bills'] = array('Rechnungsfelder', 'Wählen Sie die Felder der Rechnung und deren Reihenfolge aus.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['fields_offers'] = array('Angebotsfelder', 'Wählen Sie die Felder der Angebote und deren Reihenfolge aus.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['fields_types'] = array(
	'position' => 'Position',
	'description' => 'Name und Beschreibung',
	'quantity' => 'Menge',
	'period' => 'Zeitraum',
	'price_unit' => 'Einzelpreis',
	'price_subtotal' => 'Preis Netto',
	'price_tax' => 'Enthaltene Steuer',
	'price_total' => 'Preis Gesamt'
);

$GLOBALS['TL_LANG']['tl_accounting_settings']['path_bills'] = array('Speicherort für Rechnungen', 'Geben Sie einen Zielordner zum Speichern der generierten Rechnungen an.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['path_offers'] = array('Speicherort für Angebote', 'Geben Sie einen Zielordner zum Speichern der generierten Angebote an.');

$GLOBALS['TL_LANG']['tl_accounting_settings']['accounting_currency'] = array('Währung', 'Geben Sie die für die Buchhaltung im Schriftverkehr zu nutzende Währung an.<br>Im ersten Feld wird ein Klartextname  erwartet und im zweiten Feld kann ein Währungssymbol hinterlegt werden.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['accounting_taxes'] = array('Steuersätze', 'Hinterlegen Sie Steuersätze zur Verrechnung.');
$GLOBALS['TL_LANG']['tl_accounting_settings']['accounting_tax_value'] = 'Steuersatz';
$GLOBALS['TL_LANG']['tl_accounting_settings']['accounting_tax_name'] = 'Bezeichnung';
$GLOBALS['TL_LANG']['tl_accounting_settings']['accounting_tax_abbr'] = 'Abkürzung';
$GLOBALS['TL_LANG']['tl_accounting_settings']['accounting_units'] = array('Verfügbare Einheiten', 'Geben Sie die für die Buchhaltung verfügbaren Einheiten an.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_accounting_settings']['no_legend'] = 'Automatisierte Nummerierung';
$GLOBALS['TL_LANG']['tl_accounting_settings']['unit_legend'] = 'Einheiten';
$GLOBALS['TL_LANG']['tl_accounting_settings']['output_legend'] = 'Speicherorte';
$GLOBALS['TL_LANG']['tl_accounting_settings']['layout_legend'] = 'Layout';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_accounting_settings']['edit'] = 'Die accounting Einstellungen bearbeiten';
