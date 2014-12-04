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
$GLOBALS['TL_LANG']['tl_kd_stock']['type'] = array('Typ', 'Wählen Sie die Art der Warenbewegung.');
$GLOBALS['TL_LANG']['tl_kd_stock']['types'] = array(
	'incoming' => array('Produktion', 'Ein Wareneingang, zum Beispiel durch eine Produktion.'),
	'outgoing' => array('Entnahme', 'Ein Warenausgang, durch Verkauf, Promotion oder Ähnliches.'),
	'order' => array('Bestellung', 'Merkt eine bestimmbare Menge bis zu einem zukünftigen Zeitpunkt als reserviert vor.')
);
$GLOBALS['TL_LANG']['tl_kd_stock']['date'] = array('Datum', 'Geben Sie das Datum der Warenbewegung an.');
$GLOBALS['TL_LANG']['tl_kd_stock']['formula'] = array('Rezept', 'Wählen Sie das dem Produkt zugrunde liegende Rezept.');
$GLOBALS['TL_LANG']['tl_kd_stock']['quantity'] = array('Menge', 'Geben Sie die Menge an.');
$GLOBALS['TL_LANG']['tl_kd_stock']['expiry_fridge'] = array('Haltbarkeit Kühlschrank (+7°C)', 'Das Mindesthaltbarkeitsdatum bei unter 7° Celsius.');
$GLOBALS['TL_LANG']['tl_kd_stock']['expiry_frost'] = array('Haltbarkeit Gefrierschrank (-18°C)', 'Das Mindesthaltbarkeitsdatum bei unter -18° Celsius.');
$GLOBALS['TL_LANG']['tl_kd_stock']['delivery'] = array('Lieferdatum', 'Das vereinbarte Lieferdatum bis zu welchem die Ware reserviert bleibt.');
$GLOBALS['TL_LANG']['tl_kd_stock']['disabled'] = array('Deaktiviert', 'Deaktiviert die Bestellung und entnimmt sie der Kalkulation.');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_kd_stock']['type_legend'] = 'Art';
$GLOBALS['TL_LANG']['tl_kd_stock']['product_legend'] = 'Produkt und Menge';
$GLOBALS['TL_LANG']['tl_kd_stock']['expiry_legend'] = 'Mindesthaltbarkeit (MHD)';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_kd_stock']['new'] = array('Neue Warenbewegung', 'Eine neue Warenbewegung anlegen.');
$GLOBALS['TL_LANG']['tl_kd_stock']['show'] = array('Bewegungsdetails', 'Details der Warenbewegung ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_kd_stock']['edit'] = array('Warenbewegung bearbeiten', 'Warenbewegung ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_kd_stock']['copy'] = array('Warenbewegung duplizieren', 'Warenbewegung ID %s duplizieren');
$GLOBALS['TL_LANG']['tl_kd_stock']['delete'] = array('Warenbewegung löschen', 'Warenbewegung ID %s löschen');
