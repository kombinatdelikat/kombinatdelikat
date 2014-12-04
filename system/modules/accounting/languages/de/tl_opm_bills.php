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
$GLOBALS['TL_LANG']['tl_accounting_bills']['no'] = array('Rechnungsnummer', 'Wird beim Drucken automatisch erstellt, wenn das Feld leer gelassen wurde. <strong>Lässt sich nach dem Druck nicht mehr anpassen!</strong>');
$GLOBALS['TL_LANG']['tl_accounting_bills']['locked'] = array('Geschützt', 'Eine Rechnung wird nach dem Drucken geschützt, um die Bearbeitung zu verhindern. Einmal entsperrt, lässt sich alles <strong>bis auf die Rechnungsnummer</strong> anpassen.');
$GLOBALS['TL_LANG']['tl_accounting_bills']['date'] = array('Rechnungsdatum', 'Das Datum der Rechnung.');
$GLOBALS['TL_LANG']['tl_accounting_bills']['due'] = array('Fälligkeit', 'Der Zeitraum in Tagen bis zur Fälligkeit der Rechnung.');
$GLOBALS['TL_LANG']['tl_accounting_bills']['customer'] = array('Kunde', 'Der rechnungsempfangende Kunde.');
$GLOBALS['TL_LANG']['tl_accounting_bills']['responsible'] = array('Verantwortlicher', 'Der verantwortliche Kundebetreuer.');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_accounting_bills']['date_legend'] = 'Datum';
$GLOBALS['TL_LANG']['tl_accounting_bills']['content_legend'] = 'Inhalte';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_accounting_bills']['new'] = array('Neue Rechnung', 'Eine neue Rechnung anlegen.');
$GLOBALS['TL_LANG']['tl_accounting_bills']['show'] = array('Rechnungsdetails', 'Details der Rechnung ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_accounting_bills']['edit'] = array('Rechnung bearbeiten', 'Rechnung ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_accounting_bills']['copy'] = array('Rechnung duplizieren', 'Rechnung ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_accounting_bills']['print'] = array('Rechnung drucken', 'Rechnung ID %s drucken');
$GLOBALS['TL_LANG']['tl_accounting_bills']['delete'] = array('Rechnung löschen', 'Rechnung ID %s löschen');
