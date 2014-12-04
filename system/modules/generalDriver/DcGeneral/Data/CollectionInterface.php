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

namespace DcGeneral\Data;

use DcGeneral\Data\ModelInterface;

/**
 * Interface InterfaceGeneralCollection
 *
 * This represents an iterable collection of Model elements.
 */
interface CollectionInterface extends \IteratorAggregate
{
	/**
	 * Get length of this collection.
	 *
	 * @return int
	 */
	public function length();

	/**
	 * Get the model at a specific index.
	 *
	 * @param integer $intIndex The index of the model to retrieve.
	 *
	 * @return ModelInterface
	 */
	public function get($intIndex);

	/**
	 * Alias for push - Append a model to the end of this collection.
	 *
	 * @param ModelInterface $objModel The model to append to the collection.
	 *
	 * @return void
	 *
	 * @see push
	 */
	public function add(ModelInterface $objModel);

	/**
	 * Append a model to the end of this collection.
	 *
	 * @param ModelInterface $objModel The model to append to the collection.
	 *
	 * @return void
	 */
	public function push(ModelInterface $objModel);

	/**
	 * Remove the model at the end of the collection and return it.
	 *
	 * If the collection is empty, null will be returned.
	 *
	 * @return ModelInterface
	 */
	public function pop();

	/**
	 * Insert a model at the beginning of the collection.
	 *
	 * @param ModelInterface $objModel The model to insert into the collection.
	 *
	 * @return void
	 */
	public function unshift(ModelInterface $objModel);

	/**
	 * Remove the model from the beginning of the collection and return it.
	 *
	 * If the collection is empty, null will be returned.
	 *
	 * @return ModelInterface
	 */
	public function shift();

	/**
	 * Insert a record at the specific position.
	 *
	 * Move all records at position >= $index one index up.
	 * If $index is out of bounds, just add at the end (does not fill with empty records!).
	 *
	 * @param integer $intIndex  The index where the model shall be placed.
	 *
	 * @param ModelInterface   $objModel The model to insert.
	 *
	 * @return void
	 */
	public function insert($intIndex, ModelInterface $objModel);

	/**
	 * Remove the given index or model from the collection and renew the index.
	 *
	 * ATTENTION: Don't use key to unset in foreach because of the new index.
	 *
	 * @param mixed $mixedValue The index (integer) or InterfaceGeneralModel instance to remove.
	 *
	 * @return void
	 */
	public function remove($mixedValue);

	/**
	 * Make a reverse sorted collection of this collection.
	 *
	 * @return ModelInterface
	 */
	public function reverse();

	/**
	 * Sort the records with the given callback and return the new sorted collection.
	 *
	 * @param callback $callback
	 *
	 * @return ModelInterface
	 */
	public function sort($callback);
}
