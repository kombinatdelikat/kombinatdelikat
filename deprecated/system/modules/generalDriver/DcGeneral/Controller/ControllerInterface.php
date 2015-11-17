<?php
/**
 * PHP version 5
 * @package    generalDriver
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace DcGeneral\Controller;

use DcGeneral\DataContainerInterface;

// TODO: we need to flesh this out some more out and add real interface methods. Currently this interface is rather useless.
interface ControllerInterface
{

	/**
	 * Set the DataContainerInterface.
	 *
	 * @param DataContainerInterface $objDC
	 */
	public function setDC($objDC);

	/**
	 * Get the DataContainerInterface.
	 *
	 * @return DataContainerInterface
	 */
	public function getDC();

	public function generateAjaxPalette($strSelector);

	public function ajaxTreeView($mixID, $intLevel);

	public function copy();

	public function create();

	public function cut();

	public function delete();

	public function edit();

	public function move();

	public function show();

	/**
	 * Show all entries from a table
	 *
	 * @return void | String if error
	 */
	public function showAll();

	public function executePostActions();
}
