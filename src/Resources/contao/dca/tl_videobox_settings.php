<?php

if (!defined('TL_ROOT')) {
    die('You cannot access this file directly!');
}
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
 * Table tl_videobox_settings
 */
$GLOBALS['TL_DCA']['tl_videobox_settings'] =
[

    // Config
    'config' =>
    [
        'dataContainer'               => 'Table',
        'ptable'                      => 'tl_videobox_archive',
        'onload_callback'             => [['tl_videobox_settings', 'hideFields']]
    ],

    // List
    'list' =>
    [
        'sorting' =>
        [
            'mode'                    => 1,
            'fields'                  => ['youtube_template'],
            'flag'                    => 1,
            'panelLayout'             => 'filter;search,limit'
        ],
        'label' =>
        [
            'fields'                  => ['youtube_template'],
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
                'label'               => &$GLOBALS['TL_LANG']['tl_videobox_settings']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ],
            'copy' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_videobox_settings']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ],
            'delete' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_videobox_settings']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if (!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? '') . '\')) return false; Backend.getScrollOffset();"'
            ],
            'show' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_videobox_settings']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            ]
        ]
    ],

    // Palettes
    'palettes' =>
    [
        'default'                     => '{youtube_legend},youtube_template,youtube_size,youtube_rel,youtube_autoplay,youtube_loop,youtube_border,youtube_color1,youtube_color2,youtube_start,youtube_fs,youtube_hd,youtube_showinfo;'
    ],

    // Fields
    'fields' =>
    [
        'youtube_template' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_template'],
            'default'                 => 'videobox_youtube',
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => $this->getTemplateGroup('videobox_'),
            'eval'                    => ['tl_class' => 'w50']
        ],
        'youtube_size' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_size'],
            'default'                 => [425,344],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true, 'multiple' => true, 'size' => 2, 'rgxp' => 'digit', 'nospace' => true, 'tl_class' => 'w50']
        ],
        'youtube_rel' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_rel'],
            'default'                 => true,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'w50 cbx']
        ],
        'youtube_autoplay' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_autoplay'],
            'default'                 => false,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'w50 cbx']
        ],
        'youtube_loop' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_loop'],
            'default'                 => false,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'w50 cbx']
        ],
        'youtube_border' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_border'],
            'default'                 => false,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'w50 cbx']
        ],
        'youtube_color1' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_color1'],
            'default'                 => '000000',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['maxlength' => 6,'tl_class' => 'w50']
        ],
        'youtube_color2' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_color2'],
            'default'                 => 'FFFFFF',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['maxlength' => 6,'tl_class' => 'w50']
        ],
        'youtube_start' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_start'],
            'default'                 => '0',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp' => 'digit','tl_class' => 'w50']
        ],
        'youtube_fs' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_fs'],
            'default'                 => false,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'w50 cbx m12']
        ],
        'youtube_hd' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_hd'],
            'default'                 => false,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'w50 cbx']
        ],
        'youtube_showinfo' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_showinfo'],
            'default'                 => true,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'w50 cbx']
        ]
    ]
];

// Vimeo
$GLOBALS['TL_DCA']['tl_videobox_settings']['list']['sorting']['fields'][] = 'vimeo_template';
$GLOBALS['TL_DCA']['tl_videobox_settings']['list']['label']['fields'][] = 'vimeo_template';
$GLOBALS['TL_DCA']['tl_videobox_settings']['palettes']['default'] .= '{vimeo_legend},vimeo_template,vimeo_size,vimeo_color,vimeo_autopause,vimeo_autoplay,vimeo_badge,vimeo_showbyline,vimeo_showtitle,vimeo_fs,vimeo_showportrait;';
$GLOBALS['TL_DCA']['tl_videobox_settings']['fields'] += [
    'vimeo_template' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_template'],
        'default'                 => 'videobox_vimeo',
        'exclude'                 => true,
        'inputType'               => 'select',
        'options'                 => $this->getTemplateGroup('videobox_'),
        'eval'                    => ['tl_class' => 'w50']
    ],
    'vimeo_size' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_size'],
        'default'                 => [425,344],
        'exclude'                 => true,
        'inputType'               => 'text',
        'eval'                    => ['mandatory' => true, 'multiple' => true, 'size' => 2, 'rgxp' => 'digit', 'nospace' => true, 'tl_class' => 'w50']
    ],
    'vimeo_color' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_color'],
        'default'                 => '',
        'exclude'                 => true,
        'inputType'               => 'text',
        'eval'                    => ['maxlength' => 6,'tl_class' => 'w50']
    ],
    'vimeo_autopause' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_autopause'],
        'default'                 => true,
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => ['tl_class' => 'clr w50 cbx']
    ],
    'vimeo_autoplay' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_autoplay'],
        'default'                 => false,
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => ['tl_class' => 'w50 cbx']
    ],
    'vimeo_badge' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_badge'],
        'default'                 => true,
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => ['tl_class' => 'w50 cbx']
    ],
    'vimeo_showbyline' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_showbyline'],
        'default'                 => true,
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => ['tl_class' => 'w50 cbx']
    ],
    'vimeo_showtitle' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_showtitle'],
        'default'                 => true,
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => ['tl_class' => 'w50 cbx']
    ],
    'vimeo_fs' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_fs'],
        'default'                 => false,
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => ['tl_class' => 'w50 cbx']
    ],
    'vimeo_showportrait' =>
    [
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox_settings']['vimeo_showportrait'],
        'default'                 => true,
        'exclude'                 => true,
        'inputType'               => 'checkbox',
        'eval'                    => ['tl_class' => 'w50 cbx']
    ]
];

class tl_videobox_settings extends \Backend
{
    /**
     * Hide the corresponding fields if they have been deactivated in the archive
     * @param object
     */
    public function hideFields(\DataContainer $dc)
    {
        // get pid
        $objPid = $this->Database->prepare("SELECT pid FROM tl_videobox_settings WHERE id=?")
                                 ->execute($dc->id);

        // get all active videotypes
        $objAVT = $this->Database->prepare("SELECT activeVideoTypes FROM tl_videobox_archive WHERE id=?")
                                         ->execute($objPid->pid);

        // if there is absolutely no video type active, we're going to unset all the fields
        if (strlen($objAVT->activeVideoTypes) == 0) {
            $GLOBALS['TL_DCA']['tl_videobox_settings']['palettes']['default'] = '';
            return;
        }

        // else we have to look for the intersection
        $arrAVT = deserialize($objAVT->activeVideoTypes);

        // build disallowed videotypes array
        $arrDAVT = $GLOBALS['VIDEOBOX']['VideoType'];

        foreach ($arrAVT as $k => $vidType) {
            unset($arrDAVT[$vidType]);
        }

        // check the palette
        foreach ($arrDAVT as $k => $vidType) {
            // awful regexp - thanks to chris (Xtra) for support - you're the man!
            $GLOBALS['TL_DCA']['tl_videobox_settings']['palettes']['default'] = preg_replace('#|(\{' . $vidType . '_[^}]*\}(\s*)(,|;)(\s*))|(' . $vidType . '_[^,;}]*(\s*)(,|;)(\s*))#i', '', $GLOBALS['TL_DCA']['tl_videobox_settings']['palettes']['default']);
        }
    }
}
