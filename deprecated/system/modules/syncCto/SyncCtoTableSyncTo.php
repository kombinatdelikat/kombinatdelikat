<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2014
 * @package    syncCto
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Class for syncTo configurations
 */
class SyncCtoTableSyncTo extends Backend
{
    // Vars
    protected $objSyncCtoHelper;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->objSyncCtoHelper = SyncCtoHelper::getInstance();

        parent::__construct();
    }

    /**
     * Set new and remove old buttons
     *
     * @param DataContainer $dc
     */
    public function onload_callback(DataContainer $dc)
    {
        if (\Input::getInstance()->get('act') == 'start' || get_class($dc) != 'DC_General')
        {
            return;
        }

        $strInitFilePath = '/system/config/initconfig.php';

        if (file_exists(TL_ROOT . $strInitFilePath))
        {
            $strFile        = new File($strInitFilePath);
            $arrFileContent = $strFile->getContentAsArray();
            foreach ($arrFileContent AS $strContent)
            {
                if (!preg_match("/(\/\*|\*|\*\/|\/\/)/", $strContent))
                {
                    //system/tmp.
                    if (preg_match("/system\/tmp/", $strContent))
                    {
                        // Set data.
                        \Message::addInfo($GLOBALS['TL_LANG']['MSC']['disabled_cache']);
                    }
                }
            }
        }

        // Add/Remove some buttons.
        $dc->removeButton('save');
        $dc->removeButton('saveNclose');

        // If C2, use the normal sync settings.
        $arrData = array
        (
            'id'              => 'start_sync',
            'formkey'         => 'start_sync',
            'class'           => '',
            'accesskey'       => 'g',
            'value'           => specialchars($GLOBALS['TL_LANG']['MSC']['sync']),
            'button_callback' => array('SyncCtoTableSyncTo', 'onsubmit_callback')
        );
        $dc->addButton('start_sync', $arrData);

        // If C3, use the syncAll settings.
        $arrData = array
        (
            'id'              => 'start_sync_all',
            'formkey'         => 'start_sync_all',
            'class'           => '',
            'accesskey'       => 'g',
            'value'           => specialchars($GLOBALS['TL_LANG']['MSC']['syncAll']),
            'button_callback' => array('SyncCtoTableSyncTo', 'onsubmit_callback_all')
        );
        $dc->addButton('start_sync_all', $arrData);

        // Update a field with last sync information
        $objSyncTime = $this->Database
            ->prepare("SELECT cl.syncTo_tstamp as syncTo_tstamp, user.name as syncTo_user, user.username as syncTo_alias
                            FROM tl_synccto_clients as cl
                            INNER JOIN tl_user as user
                            ON cl.syncTo_user = user.id
                            WHERE cl.id = ?")
            ->limit(1)
            ->execute(\Input::getInstance()->get("id"));

        if ($objSyncTime->syncTo_tstamp != 0 && strlen($objSyncTime->syncTo_user) != 0 && strlen($objSyncTime->syncTo_alias) != 0)
        {
            $strLastSync = vsprintf($GLOBALS['TL_LANG']['MSC']['last_sync'], array(
                    date($GLOBALS['TL_CONFIG']['timeFormat'], $objSyncTime->syncTo_tstamp),
                    date($GLOBALS['TL_CONFIG']['dateFormat'], $objSyncTime->syncTo_tstamp),
                    $objSyncTime->syncTo_user,
                    $objSyncTime->syncTo_alias)
            );

            // Set data
            \Message::addInfo($strLastSync);
        }
    }

    /**
     * Handle syncTo configurations
     *
     * @param DataContainer $dc
     *
     * @return array
     */
    public function onsubmit_callback(DataContainer $dc)
    {
        $strWidgetID     = $dc->getWidgetID();
        $arrSyncSettings = array();

        // Automode off.
        $arrSyncSettings["automode"] = false;

        // Synchronization type.
        if (is_array(\Input::getInstance()->post("sync_options_" . $strWidgetID)) && count(\Input::getInstance()->post("sync_options_" . $strWidgetID)) != 0)
        {
            $arrSyncSettings["syncCto_Type"] = \Input::getInstance()->post('sync_options_' . $strWidgetID);
        }
        else
        {
            $arrSyncSettings["syncCto_Type"] = array();
        }

        if (\Input::getInstance()->post("database_check_" . $strWidgetID) == 1)
        {
            $arrSyncSettings["syncCto_SyncDatabase"] = true;
        }
        else
        {
            $arrSyncSettings["syncCto_SyncDatabase"] = false;
        }

        // Systemoperation execute.
        if (\Input::getInstance()->post("systemoperations_check_" . $strWidgetID) == 1)
        {
            if (is_array(\Input::getInstance()->post("systemoperations_maintenance_" . $strWidgetID)) && count(\Input::getInstance()->post("systemoperations_maintenance_" . $strWidgetID)) != 0)
            {
                $arrSyncSettings["syncCto_Systemoperations_Maintenance"] = \Input::getInstance()->post("systemoperations_maintenance_" . $strWidgetID);
            }
            else
            {
                $arrSyncSettings["syncCto_Systemoperations_Maintenance"] = array();
            }
        }
        else
        {
            $arrSyncSettings["syncCto_Systemoperations_Maintenance"] = array();
        }

        // Attention flag.
        if (\Input::getInstance()->post("attentionFlag_" . $strWidgetID) == 1)
        {
            $arrSyncSettings["syncCto_AttentionFlag"] = true;
        }
        else
        {
            $arrSyncSettings["syncCto_AttentionFlag"] = false;
        }

        // Error msg.
        if (\Input::getInstance()->post("localconfig_error_" . $strWidgetID) == 1)
        {
            $arrSyncSettings["syncCto_ShowError"] = true;
        }
        else
        {
            $arrSyncSettings["syncCto_ShowError"] = false;
        }

        // Write all data.
        foreach ($_POST as $key => $value)
        {
            $strClearKey                                = str_replace("_" . $strWidgetID, "", $key);
            $arrSyncSettings["post_data"][$strClearKey] = \Input::getInstance()->post($key);
        }

        // Save Session.
        \Session::getInstance()->set("syncCto_SyncSettings_" . $dc->id, $arrSyncSettings);

        $this->objSyncCtoHelper->checkSubmit(array(
            'postUnset'   => array('start_sync'),
            'error'       => array(
                'key'     => 'syncCto_submit_false',
                'message' => $GLOBALS['TL_LANG']['ERR']['no_functions']
            ),
            'redirectUrl' => $this->Environment->base . "contao/main.php?do=synccto_clients&amp;table=tl_syncCto_clients_syncTo&amp;act=start&amp;step=0&amp;id=" . \Input::getInstance()->get("id")
        ));
    }

    /**
     * Handle syncTo configurations.
     *
     * @param DataContainer $dc
     *
     * @return array
     */
    public function onsubmit_callback_all(DataContainer $dc)
    {
        $strWidgetID     = $dc->getWidgetID();
        $arrSyncSettings = array();

        // Set array.
        $arrSyncSettings["automode"]                             = true;
        $arrSyncSettings["syncCto_Type"]                         = array(
            'core_change',
            'core_delete',
            'user_change',
            'user_delete',
            'localconfig_update'
        );
        $arrSyncSettings["syncCto_SyncDatabase"]                 = true;
        $arrSyncSettings["syncCto_Systemoperations_Maintenance"] = array();
        $arrSyncSettings["syncCto_AttentionFlag"]                = false;
        $arrSyncSettings["syncCto_ShowError"]                    = false;

        // Write all data
        foreach ($_POST as $key => $value)
        {
            $strClearKey                                = str_replace("_" . $strWidgetID, "", $key);
            $arrSyncSettings["post_data"][$strClearKey] = \Input::getInstance()->post($key);
        }

        // Save Session
        \Session::getInstance()->set("syncCto_SyncSettings_" . $dc->id, $arrSyncSettings);

        $this->objSyncCtoHelper->checkSubmit(array(
            'postUnset'   => array('start_sync'),
            'error'       => array(
                'key'     => 'syncCto_submit_false',
                'message' => $GLOBALS['TL_LANG']['ERR']['missing_tables']
            ),
            'redirectUrl' => $this->Environment->base . "contao/main.php?do=synccto_clients&amp;table=tl_syncCto_clients_syncTo&amp;act=start&amp;step=0&amp;id=" . \Input::getInstance()->get("id")
        ));
    }

}