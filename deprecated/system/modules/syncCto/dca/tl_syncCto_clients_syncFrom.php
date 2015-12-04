<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  MEN AT WORK 2014
 * @package    syncCto
 * @license    GNU/LGPL 
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_syncCto_clients_syncFrom'] = array
(
    // Config
    'config' => array
    (
        'dataContainer'           => 'General',
        'disableSubmit'           => false,
        'onload_callback' => array
        (
            array('SyncCtoTableSyncFrom', 'onload_callback')
        ),
        'onsubmit_callback' => array
        (
            array('SyncCtoTableSyncFrom', 'onsubmit_callback'),
        )
    ),
    'dca_config'  => array
    (
        'data_provider' => array
        (
            'default' => array
            (
                'class'           => 'GeneralDataSyncCto',
                'source'          => 'tl_syncCto_clients_syncTo'
            ),
        ),
    ),
    // Palettes
    'palettes' => array
    (
        '__selector__'            => array('systemoperations_check'),
        'default'                 => '{sync_legend},sync_options;{table_legend},database_check;{systemoperations_legend:hide},systemoperations_check,attentionFlag;',
    ),
    // Sub Palettes
    'subpalettes' => array
    (
        'systemoperations_check'  => 'systemoperations_maintenance',
    ),
    // Fields
    'fields' => array
    (
        'sync_options' => array
        (
            'label'               => $GLOBALS['TL_LANG']['tl_syncCto_clients_syncFrom']['sync_options'],
            'inputType'           => 'checkbox',
            'exclude'             => true,
            'reference'           => &$GLOBALS['TL_LANG']['SYC'],
            'options_callback'    => array('SyncCtoHelper', 'getFileSyncOptions'),
            'eval' => array
            (
                'multiple'        => true
            ),
        ),
        'database_check' => array
        (
            'label'               => &$GLOBALS['TL_LANG']['tl_syncCto_clients_syncFrom']['database_check'],
            'inputType'           => 'checkbox',
            'exclude'             => true,
        ),
        'systemoperations_check' => array
        (
            'label'               => &$GLOBALS['TL_LANG']['tl_syncCto_clients_syncFrom']['systemoperations_check'],
            'inputType'           => 'checkbox',
            'exclude'             => true,
            'eval' => array
            (
                'submitOnChange'  => true,
                'tl_class'        => 'clr'
            ),
        ),
        'systemoperations_maintenance' => array
        (
            'label'               => &$GLOBALS['TL_LANG']['tl_syncCto_clients_syncFrom']['systemoperations_maintenance'],
            'inputType'           => 'checkbox',
            'exclude'             => true,
            'reference'           => &$GLOBALS['TL_LANG']['SYC'],
            'eval'                => array
            (
                'multiple'        => true,
                'checkAll'        => true
            ),
            'options_callback'    => array('SyncCtoHelper', 'getMaintenanceOptions'),
        ),
        'attentionFlag' => array
        (
            'label'               => &$GLOBALS['TL_LANG']['tl_syncCto_clients_syncFrom']['attention_flag'],
            'inputType'           => 'checkbox',
            'exclude'             => true
        )
    )
);
