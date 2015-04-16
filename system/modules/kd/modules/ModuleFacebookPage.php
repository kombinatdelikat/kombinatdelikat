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

namespace KombinatDelikat\Modules;


/**
 * Front end module "facebook page".
 *
 * @author    David Enke <post@davidenke.de>
 */
class ModuleFacebookPage extends \Module
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_facebook_page';


	protected function cloneRemoteImage($strUrl, $blnForce=false)
	{
		$strBasename = explode('?', preg_replace('/.*\/(.*)(\.+.+)$/is', '$1$2', $strUrl))[0];
		$strFolder = 'files/fb/' . $this->fb_page_id;

		if (!file_exists(TL_ROOT . '/' . $strFolder . '/' . $strBasename) || $blnForce)
		{
			if (!file_exists(TL_ROOT . '/' . $strFolder))
			{
				mkdir(TL_ROOT . '/' . $strFolder, 0755, true);
			}
			if (@copy($strUrl, TL_ROOT . '/' . $strFolder . '/' . $strBasename))
			{
				return \Dbafs::addResource($strFolder . '/' . $strBasename)->uuid;
			}
		}
		else
		{
			return \FilesModel::findMultipleByPaths(array($strFolder . '/' . $strBasename), array('limit'=>1, 'return'=>'Model'))->uuid;
		}

		return;
	}


	protected function facebookConnect()
	{
		\FacebookSession::setDefaultApplication($this->fb_app_id, $this->fb_app_secret);
		$objSession = \FacebookSession::newAppSession();

		if ($objSession->validate())
		{
			$objFacebookPosts = (new \FacebookRequest($objSession, 'GET', '/' . $this->fb_page_id . '/posts'))->execute()->getGraphObject();
			$arrFacebookPosts = $objFacebookPosts->asArray();

			$objFacebookPage = (new \FacebookRequest($objSession, 'GET', '/' . $this->fb_page_id))->execute()->getGraphObject();
			$arrFacebookPage = $objFacebookPage->asArray();

			foreach ($arrFacebookPosts['data'] as &$arrFacebookPost)
			{
				$objFacebookPost = (new \FacebookRequest($objSession, 'GET', '/' . $arrFacebookPost->id . '?fields=full_picture'))->execute()->getGraphObject();
				$arrFacebookPost->full_picture = $objFacebookPost->getProperty('full_picture');
			}

			$arrFacebookPage['posts'] = $arrFacebookPosts;

			$this->fb_cache = serialize($arrFacebookPage);

			$this->objModel->fb_cache = $this->fb_cache;
			$this->objModel->save();

			return $this->fb_cache;
		}
	}


	public function getFacebookData($blnForce=false)
	{
		if (!$this->fb_cache || $blnForce)
		{
			$strReturn = $this->facebookConnect();
		}
		else
		{
			$strReturn = $this->fb_cache;
		}

		return unserialize($strReturn);
	}


	protected function generateElement($arrData)
	{
		$objContentModel = new \ContentModel();
		foreach ($arrData as $k=>$v)
		{
			$objContentModel->$k = $v;
		}

		$strClass = \ContentElement::findClass($objContentModel->type);
		$objContentElement = new $strClass($objContentModel, 'main');
		$strContentElement = $objContentElement->generate();

		// Execute hooks
		if ($GLOBALS['TL_HOOKS']['getContentElement'])
		{
			foreach ($GLOBALS['TL_HOOKS']['getContentElement'] as $callback)
			{
				$strContentElement = static::importStatic($callback[0])->$callback[1]($objContentModel, $strContentElement, $objContentElement);
			}
		}

		return $strContentElement;
	}


	/**
	 * Generate the module
	 */
	protected function compile()
	{
		$arrElements = array();
		$arrFacebookData = $this->getFacebookData();
		$intPid = \ContentModel::findOneBy('module', $this->id)->pid;

		$arrElements[] = $this->generateElement(array
		(
			'pid' => $intPid,
			'ptable' => 'tl_article',
			'type' => 'image',
			'typePrefix' => 'ce_',
			'classes' => array(),
			'gridColumns' => 12,
			'gridOffset' => 0,
			'gridHeight' => 'triple',
			'singleSRC' => $this->cloneRemoteImage($arrFacebookData['cover']->source),
			'headline' => $arrFacebookData['about']
		));

		// more ce's (automate by type from previous lines)
		$i = 0;
		foreach ($arrFacebookData['posts']['data'] as $arrPost)
		{
			if (in_array($arrPost->type, array('photo', 'status')) && ($arrPost->message || $arrPost->full_picture))
			{
				$strTime = \Date::parse(\Date::getNumericDateFormat(), strtotime($arrPost->updated_time));
				$strMore = '<br><a class="more" href="'.$arrPost->link.'" target="_blank">'.$GLOBALS['TL_LANG']['MSC']['more'].'</a>';
				$arrElements[] = $this->generateElement(array
				(
					'pid' => $intPid,
					'ptable' => 'tl_article',
					'type' => 'text',
					'typePrefix' => 'ce_',
					'classes' => array($i%2 ? 'even' : 'odd'),
					'gridColumns' => 4,
					'gridOffset' => 0,
					'gridHeight' => 'double',
					'addImage' => $arrPost->full_picture ? true : false,
					'singleSRC' => $this->cloneRemoteImage($arrPost->full_picture),
					'text' => '<strong>' . $strTime . '</strong><br>' . nl2br($arrPost->message) . $strMore
				));
				++$i;
			}
		}

		$this->Template->elements = $arrElements;
	}
}
