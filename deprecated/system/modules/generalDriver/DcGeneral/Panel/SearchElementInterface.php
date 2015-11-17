<?php

namespace DcGeneral\Panel;

interface SearchElementInterface extends PanelElementInterface
{
	/**
	 * @param string $strProperty The property to allow to search on.
	 *
	 * @return SearchElementInterface
	 */
	public function addProperty($strProperty);

	/**
	 * Retrieve the list of properties to allow search on.
	 *
	 * @return string[]
	 */
	public function getPropertyNames();

	/**
	 * This activates a property for search.
	 *
	 * @param string $strProperty The property to activate search on.
	 *
	 * @return SearchElementInterface
	 */
	public function setSelectedProperty($strProperty = '');

	/**
	 * Retrieves the property currently defined to be searched on.
	 *
	 * @return string
	 */
	public function getSelectedProperty();

	/**
	 * Set the value to search for.
	 *
	 * @param mixed $mixValue The value to filter for.
	 *
	 * @return SearchElementInterface
	 */
	public function setValue($mixValue = null);

	/**
	 * @return mixed
	 */
	public function getValue();
}
