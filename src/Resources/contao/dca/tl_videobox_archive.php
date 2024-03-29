<?php

/**
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @category    contao-module-videobox
 * @package     dca
 * @author      Michael Lämmlein <laemmi@spacerabbit.de>
 * @copyright   ©2016 laemmi
 * @license     http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version     1.0.0
 * @since       10.03.16
 */

/**
 * Table tl_videobox_archive
 */
$GLOBALS['TL_DCA']['tl_videobox_archive'] =
[

    // Config
    'config' =>
    [
        'dataContainer'               => 'Table',
        'ctable'                      => ['tl_videobox','tl_videobox_settings'],
        'switchToEdit'                => true,
        'enableVersioning'            => true,
        'onload_callback'             =>
        [
            ['tl_videobox_archive', 'checkPermission']
        ]
    ],

    // List
    'list' =>
    [
        'sorting' =>
        [
            'mode'                    => 1,
            'fields'                  => ['title'],
            'flag'                    => 1,
            'panelLayout'             => 'filter;search,limit'
        ],
        'label' =>
        [
            'fields'                  => ['title'],
            'format'                  => '%s'
        ],
        'global_operations' =>
        [
            'all' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset();"'
            ]
        ],
        'operations' =>
        [
            'edit' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_videobox_archive']['edit'],
                'href'                => 'table=tl_videobox',
                'icon'                => 'edit.gif'
            ],
            'copy' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_videobox_archive']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ],
            'delete' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_videobox_archive']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if (!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? '') . '\')) return false; Backend.getScrollOffset();"'
            ],
            'show' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_videobox_archive']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            ],
            'editvideosettings' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_videobox_archive']['editvideosettings'],
                'href'                => 'key=videobox_settings',
                'icon'                => 'system/modules/videobox/assets/editvideosettings.png'
            ],
        ]
    ],

    // Palettes
    'palettes' =>
    [
        'default'                     => '{title_legend},title,activeVideoTypes,allowedUserGroups;'
    ],

    // Fields
    'fields' =>
    [
        'title' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_archive']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true]
        ],
        'activeVideoTypes' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_archive']['activeVideoTypes'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'options_callback'        => ['tl_videobox_archive', 'getVideoTypes'],
            'eval'                    => ['multiple' => true]
        ],
        'allowedUserGroups' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_archive']['allowedUserGroups'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'foreignKey'              => 'tl_user_group.name',
            'eval'                    => ['multiple' => true]
        ]
    ]
];

class tl_videobox_archive extends \Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Check permissions to edit table tl_videobox_archive
     */
    public function checkPermission()
    {
        if ($this->User->isAdmin) {
            return;
        }

        // Set root IDs
        if (!is_array($this->User->videobox_archives) || count($this->User->videobox_archives) < 1) {
            $root = [0];
        } else {
            $root = $this->User->videobox_archives;
        }

        $GLOBALS['TL_DCA']['tl_videobox_archive']['list']['sorting']['root'] = $root;

        // Check permissions to add archives
        if (!$this->User->hasAccess('create', 'videobox_operations')) {
            $GLOBALS['TL_DCA']['tl_videobox_archive']['config']['closed'] = true;
        }

        // Check current action
        switch ($this->Input->get('act')) {
            case 'create':
            case 'select':
                // Allow
                break;

            case 'edit':
                // Dynamically add the record new record to the allowed archives if the user is allowed to create new entries
                if (!in_array($this->Input->get('id'), $root)) {
                    $arrNew = $this->Session->get('new_records');

                    if (is_array($arrNew['tl_videobox_archive']) && in_array($this->Input->get('id'), $arrNew['tl_videobox_archive'])) {
                        // Add permissions on user level
                        if ($this->User->inherit == 'custom' || !$this->User->groups[0]) {
                            $objUser = $this->Database->prepare("SELECT videobox_archives, videobox_operations FROM tl_user WHERE id=?")
                                                       ->limit(1)
                                                       ->execute($this->User->id);

                            $arrOperations = deserialize($objUser->videobox_operations);

                            if (is_array($arrOperations) && in_array('create', $arrOperations)) {
                                $arrArchives = deserialize($objUser->videobox_archives);
                                $arrArchives[] = $this->Input->get('id');

                                $this->Database->prepare("UPDATE tl_user SET videobox_archives=? WHERE id=?")
                                               ->execute(serialize($arrArchives), $this->User->id);
                            }
                        }

                        // Add permissions on group level
                        elseif ($this->User->groups[0] > 0) {
                            $objGroup = $this->Database->prepare("SELECT videobox_archives, videobox_operations FROM tl_user_group WHERE id=?")
                                                       ->limit(1)
                                                       ->execute($this->User->groups[0]);

                            $arrOperations = deserialize($objGroup->videobox_operations);

                            if (is_array($arrOperations) && in_array('create', $arrOperations)) {
                                $arrArchives = deserialize($objGroup->videobox_archives);
                                $arrArchives[] = $this->Input->get('id');

                                $this->Database->prepare("UPDATE tl_user_group SET videobox_archives=? WHERE id=?")
                                               ->execute(serialize($arrArchives), $this->User->groups[0]);
                            }
                        }

                        // Add new element to the user object
                        $root[] = $this->Input->get('id');
                        $this->User->videobox_archives = $root;
                    }
                }
                // No break;

            case 'copy':
            case 'delete':
            case 'show':
                if (!in_array($this->Input->get('id'), $root) || ($this->Input->get('act') == 'delete' && !$this->User->hasAccess('delete', 'videobox_operations'))) {
                    $this->log('Not enough permissions to ' . $this->Input->get('act') . ' videobox archive ID "' . $this->Input->get('id') . '"', __METHOD__, TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;

            case 'editAll':
            case 'deleteAll':
            case 'overrideAll':
                $session = $this->Session->getData();
                if ($this->Input->get('act') == 'deleteAll' && !$this->User->hasAccess('delete', 'videobox_operations')) {
                    $session['CURRENT']['IDS'] = [];
                } else {
                    $session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
                }
                $this->Session->setData($session);
                break;

            default:
                if (strlen($this->Input->get('act'))) {
                    $this->log('Not enough permissions to ' . $this->Input->get('act') . ' videobox archives', __METHOD__, TL_ERROR);
                    $this->redirect('contao/main.php?act=error');
                }
                break;
        }
    }

    /**
     * Method to list all video types
     * @return array
     */
    public function getVideoTypes()
    {
        $arrTypes = [];

        foreach (array_keys($GLOBALS['VIDEOBOX']['VideoType']) as $type) {
            $arrTypes[$type] = $GLOBALS['TL_LANG']['VideoTypes'][$type];
        }

        return $arrTypes;
    }
}
