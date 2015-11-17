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
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['title'] = array('Titel', 'Geben Sie einen Titel an.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['path'] = array('Zielordner', 'Geben Sie einen Zielordner zum Speichern der generierten Dokumente an.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['tpl_pdf'] = array('Hintergrund', 'Geben Sie eine PDF-Datei zur Darstellung im Hintergrund des Layouts an. Die letzte Seite wird fortlaufend wiederholt.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['css'] = array('Stylesheet', 'Geben Sie eine CSS-Datei zur Formatierung an.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fields'] = array('Felder', 'Wählen Sie die Felder des Layouts und deren Reihenfolge aus.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fields_overview'] = array('Übersichtsfelder', 'Wählen Sie die Felder der Übersichtselemente und deren Reihenfolge aus.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fields_types'] = array(
	'position' => 'Position',
	'description' => 'Name und Beschreibung',
	'category' => 'Kategorie',
	'quantity' => 'Menge',
	'period' => 'Zeitraum',
	'price_unit' => 'Einzelpreis',
	'price_subtotal' => 'Preis Netto',
	'price_tax' => 'Enthaltene Steuer',
	'price_total' => 'Preis Gesamt'
);
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['format'] = array('Format', 'Wählen Sie ein Format für das Layout.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['formats'] = array(
	'A4' => 'A4'
);
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fontfamily'] = array('Schriftfamilie', 'Geben Sie die Standardschriftfamilie des Layouts an.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['fontsize'] = array('Schriftgröße', 'Geben Sie die Standardschriftgröße des Layouts an.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['margin'] = array('Abstände', 'Geben Sie die Abstände des Layouts zum Dokumentrand in Millimetern im Uhrzeigersinn an (oben, rechts, links, unten).');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['orientation'] = array('Ausrichtung', 'Wählen Sie die Ausrichtung des Layouts.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['orientations'] = array(
	'P' => 'Hochformat',
	'L' => 'Querformat'
);


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['title_legend'] = 'Titel';
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['layout_legend'] = 'Hintergrund und Erscheinung';
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['font_legend'] = 'Schriften';
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['output_legend'] = 'Speicherort';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['new'] = array('Neues Layout', 'Ein neues Layout anlegen.');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['show'] = array('Layoutdetails', 'Details des Layouts ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['edit'] = array('Layout bearbeiten', 'Layout ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['copy'] = array('Layout duplizieren', 'Layout ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_accounting_settings_layouts']['delete'] = array('Layout löschen', 'Layout ID %s löschen');
