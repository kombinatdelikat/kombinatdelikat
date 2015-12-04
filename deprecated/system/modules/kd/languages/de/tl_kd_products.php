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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_kd_products']['title'] = array('Name', 'Geben Sie einen Produktnamen an.');
$GLOBALS['TL_LANG']['tl_kd_products']['price_type'] = array('Preisberechnung', 'Wählen Sie die Art der Preisberechnung aus.');
$GLOBALS['TL_LANG']['tl_kd_products']['price_types'] = array(
	'fix' => array('Festpreis', 'Ein pauschaler Preis pro Kilogramm netto.'),
	'tiers_count' => array('Staffelpreis nach Stückzahl', 'Festlegung von Staffelpreisen netto pro Kilogramm, abhängig von der Anzahl.'),
	'tiers_weight' => array('Staffelpreis nach Gewicht', 'Festlegung von Staffelpreisen netto pro Kilogramm, abhängig vom Gewicht in Kilogramm.')
);
$GLOBALS['TL_LANG']['tl_kd_products']['price_fix'] = 'Festpreis';
$GLOBALS['TL_LANG']['tl_kd_products']['price_tiers'] = 'Staffelpreise';
$GLOBALS['TL_LANG']['tl_kd_products']['range_from_count'] = 'Kilopreis ab einer Stückzahl von';
$GLOBALS['TL_LANG']['tl_kd_products']['range_from_weight'] = 'Kilopreis ab einem Gewicht in Kilogramm von';
$GLOBALS['TL_LANG']['tl_kd_products']['range_price'] = 'Preis netto';

$GLOBALS['TL_LANG']['tl_kd_products']['tiers'] = 'Staffel';
$GLOBALS['TL_LANG']['tl_kd_products']['price'] = 'Preis Netto';
$GLOBALS['TL_LANG']['tl_kd_products']['gross'] = 'Preis Brutto';


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_kd_products']['title_legend'] = 'Titel';
$GLOBALS['TL_LANG']['tl_kd_products']['price_legend'] = 'Preis';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_kd_products']['new'] = array('Neues Produkt', 'Ein neues Produkt anlegen.');
$GLOBALS['TL_LANG']['tl_kd_products']['show'] = array('Produktdetails', 'Details des Produktes ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_kd_products']['edit'] = array('Produkt bearbeiten', 'Produkt ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_kd_products']['copy'] = array('Produkt duplizieren', 'Produkt ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_kd_products']['delete'] = array('Produkt löschen', 'Produkt ID %s löschen');
