<?php

namespace DcGeneral\Panel;

use DcGeneral\Data\ConfigInterface;
use DcGeneral\Panel\PanelContainerInterface;
use DcGeneral\Panel\PanelElementInterface;
use DcGeneral\Panel\PanelInterface;

class DefaultPanel implements PanelInterface
{
	/**
	 * @var PanelContainerInterface
	 */
	protected $objContainer;

	/**
	 * @var PanelElementInterface[]
	 */
	protected $arrElements;


	public function __construct()
	{
		$this->arrElements = array();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getContainer()
	{
		return $this->objContainer;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setContainer(PanelContainerInterface $objContainer)
	{
		$this->objContainer = $objContainer;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function addElement($strKey, $objElement)
	{
		$this->arrElements[$strKey] = $objElement;
		$objElement->setPanel($this);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getElement($strKey)
	{
		return $this->arrElements[$strKey];
	}

	/**
	 * {@inheritdoc}
	 */
	public function initialize(ConfigInterface $objConfig, PanelElementInterface $objElement = null)
	{
		/** @var PanelElementInterface $objThisElement */
		foreach ($this as $objThisElement)
		{
			$objThisElement->initialize($objConfig, $objElement);
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->arrElements);
	}
}
