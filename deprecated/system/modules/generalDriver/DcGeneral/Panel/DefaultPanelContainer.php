<?php

namespace DcGeneral\Panel;

use DcGeneral\DataDefinition\ContainerInterface;
use DcGeneral\Data\ConfigInterface;
use DcGeneral\DataContainerInterface;
use DcGeneral\Panel\PanelContainerInterface;
use DcGeneral\Panel\PanelElementInterface;
use DcGeneral\Panel\PanelInterface;

class DefaultPanelContainer implements PanelContainerInterface
{
	/**
	 * @var DataContainerInterface
	 */
	protected $objDataContainer;

	/**
	 * @var PanelInterface[]
	 */
	protected $arrPanels = array();

	/**
	 * {@inheritdoc}
	 */
	public function getDataContainer()
	{
		return $this->objDataContainer;
	}
	/**
	 * {@inheritdoc}
	 */
	public function setDataContainer(DataContainerInterface $objDataContainer)
	{
		$this->objDataContainer = $objDataContainer;
		return $this;
	}

	/**
	 * @param string $strKey  Name of the panel.
	 *
	 * @param PanelInterface $objPanel
	 *
	 * @return mixed
	 */
	public function addPanel($strKey, $objPanel)
	{
		$this->arrPanels[$strKey] = $objPanel;
		$objPanel->setContainer($this);

		return $this;
	}

	/**
	 * @param $strKey
	 *
	 * @return PanelInterface
	 */
	public function getPanel($strKey)
	{
		return $this->arrPanels[$strKey];
	}

	public function initialize(ConfigInterface $objConfig, PanelElementInterface $objElement = null)
	{
		/** @var PanelInterface $objPanel */
		foreach ($this as $objPanel)
		{
			$objPanel->initialize($objConfig, $objElement);
		}
	}

	/**
	 * @param PanelInterface      $objPanel
	 *
	 * @param ContainerInterface $objDefinition
	 */
	protected function buildFilter(PanelInterface $objPanel, $objDefinition)
	{
		foreach ($objDefinition->getPropertyNames() as $strProperty)
		{
			$objProperty = $objDefinition->getProperty($strProperty);

			if (!$objProperty->isFilterable())
			{
				continue;
			}

			$objElement = new DefaultFilterElement();
			$objElement->setPropertyName($strProperty);

			$objPanel->addElement($strProperty, $objElement);
		}
	}

	/**
	 * @param PanelInterface      $objPanel
	 *
	 * @param ContainerInterface $objDefinition
	 */
	protected function buildSearch(PanelInterface $objPanel, $objDefinition)
	{
		$objElement = new DefaultSearchElement();

		foreach ($objDefinition->getPropertyNames() as $strProperty)
		{
			$objProperty = $objDefinition->getProperty($strProperty);

			if (!$objProperty->isSearchable())
			{
				continue;
			}

			$objElement->addProperty($strProperty);
		}

		if (count($objElement->getPropertyNames()))
		{
			$objPanel->addElement('search', $objElement);
		}
	}

	/**
	 * @param PanelInterface      $objPanel
	 *
	 * @param ContainerInterface $objDefinition
	 */
	protected function buildSort(PanelInterface $objPanel, $objDefinition)
	{
		$objElement = new DefaultSortElement();

		foreach ($objDefinition->getPropertyNames() as $strProperty)
		{
			$objProperty = $objDefinition->getProperty($strProperty);

			if (!$objProperty->isSortable())
			{
				continue;
			}

			$intFlag = $objProperty->get('flag');
			if (is_null($intFlag))
			{
				$intFlag = 0;
			}

			$objElement->addProperty($strProperty,  $intFlag);
		}

		if (count($objElement->getPropertyNames()))
		{
			$objElement->setDefaultFlag(0);

			$objPanel->addElement('sort', $objElement);
		}
	}

	protected function buildLimit(PanelInterface $objPanel)
	{
		$objElement = new DefaultLimitElement();
		$objPanel->addElement('limit', $objElement);
	}

	/**
	 * @param ContainerInterface $objDefinition
	 *
	 * @return PanelContainerInterface|void
	 * @throws \RuntimeException
	 */
	public function buildFrom($objDefinition)
	{
		$panelLayout = $objDefinition->getPanelLayout();
		$panelNames = array_keys($panelLayout);
		$lastPanelKey = array_pop($panelNames);

		foreach ($panelLayout as $strPanelKey => $arrPanel)
		{
			// We need a new panel.
			$objPanel = new DefaultPanel();
			$this->addPanel($strPanelKey, $objPanel);

			if ($strPanelKey == $lastPanelKey) {
				$objPanel->addElement('submit', new DefaultSubmitElement());
			}

			foreach ($arrPanel as $strElement)
			{
				$objElement = null;
				switch ($strElement)
				{
					case 'filter': $this->buildFilter($objPanel, $objDefinition); break;
					case 'sort':   $this->buildSort($objPanel, $objDefinition); break;
					case 'search': $this->buildSearch($objPanel, $objDefinition); break;
					case 'limit':  $this->buildLimit($objPanel); break;
					default:
						throw new \RuntimeException('Invalid panel value provided: ' . $strElement);
				}
			}
		}
	}

	public function updateValues()
	{
		return ($this->getDataContainer()->getInputProvider()->getValue('FORM_SUBMIT') === 'tl_filters');
	}

	/**
	 * {@inheritdoc}
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->arrPanels);
	}
}
