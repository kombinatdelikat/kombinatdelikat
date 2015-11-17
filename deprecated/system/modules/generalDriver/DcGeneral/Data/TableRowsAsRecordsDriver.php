<?php

/**
 * PHP version 5
 * @package    generalDriver
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace DcGeneral\Data;

/**
 * This is the MetaModel filter interface.
 *
 * @package    generalDriver
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 */
class TableRowsAsRecordsDriver extends DefaultDriver
{
	/* /////////////////////////////////////////////////////////////////////////
	 * -------------------------------------------------------------------------
	 * Getter | Setter
	 * -------------------------------------------------------------------------
	 * ////////////////////////////////////////////////////////////////////// */

	/**
	 * grouping column to use to tie rows together.
	 */
	protected $strGroupCol = 'pid';

	/**
	 * sorting column to sort the entries by.
	 */
	protected $strSortCol = '';

	/**
	 * Set base config with source and other necessary parameter.
	 *
	 * @param array $arrConfig The configuration to use.
	 *
	 * @return void
	 *
	 * @throws \Exception when no source has been defined.
	 */
	public function setBaseConfig(array $arrConfig)
	{
		parent::setBaseConfig($arrConfig);

		if (!$arrConfig['group_column'])
		{
			throw new \Exception('DcGeneral\Data\TableRowsAsRecordsDriver needs a grouping column.', 1);

		}
		$this->strGroupCol = $arrConfig['group_column'];

		if ($arrConfig['sort_column'])
		{
			$this->strSortCol = $arrConfig['sort_column'];
		}
	}

	/**
	 * Exception throwing convenience method.
	 *
	 * Convenience method in this data provider that simply throws an Exception stating that the passed method name
	 * should not be called on this data provider, as it is only intended to display an edit mask.
	 *
	 * @param string $strMethod The name of the method being called.
	 *
	 * @throws \Exception
	 */
	protected function youShouldNotCallMe($strMethod)
	{
		throw new \Exception(sprintf('Error, %s not available, as the data provider is intended for edit mode only.', $strMethod), 1);
	}


	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param mixed $item Unused.
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function delete($item)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Fetch a single record by id.
	 *
	 * This data provider only supports retrieving by id so use $objConfig->setId() to populate the config with an Id.
	 *
	 * @param ConfigInterface $objConfig
	 *
	 * @return ModelInterface
	 *
	 * @throws \Exception if config object does not contain an Id.
	 */
	public function fetch(ConfigInterface $objConfig)
	{
		if (!$objConfig->getId())
		{
			throw new \Exception('Error, no id passed, DcGeneral\Data\TableRowsAsRecordsDriver is only intended for edit mode.', 1);
		}

		$strQuery = sprintf('SELECT %s FROM %s WHERE %s=?', $this->buildFieldQuery($objConfig), $this->strSource, $this->strGroupCol);

		if ($this->strSortCol)
		{
			$strQuery .= ' ORDER BY ' . $this->strSortCol;
		}

		$objResult = $this->objDatabase
			->prepare($strQuery)
			->execute($objConfig->getId());

		$objModel = $this->getEmptyModel();
		if ($objResult->numRows)
		{
			$objModel->setProperty('rows', $objResult->fetchAllAssoc());
		}

		$objModel->setID($objConfig->getId());

		return $objModel;
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param ConfigInterface $objConfig Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function fetchAll(ConfigInterface $objConfig)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param ConfigInterface $objConfig Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function getCount(ConfigInterface $objConfig)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param string $strField Unused.
	 *
	 * @param mixed  $varNew   Unused.
	 *
	 * @param int    $intId    Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function isUniqueValue($strField, $varNew, $intId = null)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param string $strField Unused.
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function resetFallback($strField)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Save a model to the database.
	 *
	 * In general, this method fetches the solely property "rows" from the model and updates the local table against
	 * these contents.
	 *
	 * The parent id (id of the model) will get checked and reflected also for new items.
	 *
	 * When rows with duplicate ids are encountered (like from MCW for example), the dupes are inserted as new rows.
	 *
	 * @param ModelInterface $objItem   The model to save.
	 *
	 * @param bool                  $recursive Ignored as not relevant in this data provider.
	 *
	 * @return ModelInterface The passed Model.
	 *
	 * @throws \Exception When the passed model does not contain a property named "rows", an Exception is thrown.
	 */
	public function save(ModelInterface $objItem, $recursive = false)
	{
		$arrData = $objItem->getProperty('rows');
		if (!($objItem->getID() && $arrData))
		{
			throw new \Exception('invalid input data in model.', 1);
		}

		$arrKeep = array();
		foreach($arrData as $arrRow)
		{
			// TODO: add an option to restrict this to some allowed fields?
			$arrSQL = $arrRow;

			// update all.
			$intId = intval($arrRow['id']);

			// Work around the fact that multicolumnwizard does not clear any hidden fields when copying a dataset.
			// therefore we do consider any dupe as new dataset and save it accordingly.
			if (in_array($intId, $arrKeep))
			{
				$intId = 0;
				unset($arrSQL['id']);
			}

			if ($intId>0)
			{
				$this->objDatabase
					->prepare(sprintf('UPDATE %s %%s WHERE id=? AND %s=?', $this->strSource, $this->strGroupCol))
					->set($arrSQL)
					->execute($intId, $objItem->getId());
				$arrKeep[] = $intId;
			} else {
				// force group col value:
				$arrSQL[$this->strGroupCol] = $objItem->getId();
				$arrKeep[] = $this->objDatabase
					->prepare(sprintf('INSERT INTO %s %%s', $this->strSource))
					->set($arrSQL)
					->execute()
					->insertId;
			}
		}
		// house keeping, kill the rest.
		$this->objDatabase
			->prepare(sprintf(
				'DELETE FROM  %s WHERE %s=? AND id NOT IN (%s)',
				$this->strSource,
				$this->strGroupCol,
				implode(',', $arrKeep)
			))
			->execute($objItem->getId());
		return $objItem;
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param CollectionInterface $objItems Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function saveEach(CollectionInterface $objItems)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Check if the property exists in the table.
	 *
	 * This data provider only returns true for the tstamp property.
	 *
	 * @param string $strField The name of the property to check.
	 *
	 * @return boolean
	 */
	public function fieldExists($strField)
	{
		return in_array($strField, array('tstamp'));
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param mixed $mixID      Unused.
	 *
	 * @param mixed $mixVersion Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function getVersion($mixID, $mixVersion)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Return null as versioning is not supported in this data provider.
	 *
	 * @param mixed   $mixID         Unused.
	 *
	 * @param boolean $blnOnlyActive Unused.
	 *
	 * @return null
	 */
	public function getVersions($mixID, $blnOnlyActive = false)
	{
		// sorry, versioning not supported. :/
		return null;
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param ModelInterface $objModel    Unused.
	 *
	 * @param string                $strUsername Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function saveVersion(ModelInterface $objModel, $strUsername)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param mixed $mixID      Unused.
	 *
	 * @param mixed $mixVersion Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function setVersionActive($mixID, $mixVersion)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param mixed $mixID Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function getActiveVersion($mixID)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param ModelInterface $objModel1 Unused.
	 *
	 * @param ModelInterface $objModel2 Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	public function sameModels($objModel1, $objModel2)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}

	/**
	 * Unsupported in this data provider, throws an Exception.
	 *
	 * @param string $strSourceSQL Unused.
	 *
	 * @param string $strSaveSQL   Unused.
	 *
	 * @param string $strTable     Unused.
	 *
	 * @return void
	 *
	 * @throws \Exception Always throws exception.
	 */
	protected function insertUndo($strSourceSQL, $strSaveSQL, $strTable)
	{
		$this->youShouldNotCallMe(__METHOD__);
	}
}
