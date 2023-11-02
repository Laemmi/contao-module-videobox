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
 * @package     config
 * @author      Michael Lämmlein <laemmi@spacerabbit.de>
 * @copyright   ©2016 laemmi
 * @license     http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version     1.0.0
 * @since       10.03.16
 */

// BE MOD
$GLOBALS['BE_MOD']['content']['videobox'] =
[
    'tables'               => ['tl_videobox_archive','tl_videobox','tl_videobox_settings'],
    'icon'                 => 'system/modules/videobox/assets/videobox.png',
    'videobox_settings'    => ['Laemmi\Videobox\VideoBoxHelpers', 'linkToSettings']
];

// FE MOD
$GLOBALS['FE_MOD']['videobox'] =
[
    'videobox_list'     => 'ModuleVideoBoxList',
    'videobox_reader'   => 'ModuleVideoBoxReader'
];

// CE
array_insert(
    $GLOBALS['TL_CTE'],
    2,
    [
    'videos' =>
    [
        'videobox'     => 'Laemmi\Videobox\ContentVideoBox'
    ]
    ]
);

// Permissions
$GLOBALS['TL_PERMISSIONS'][] = 'videobox_archives';
$GLOBALS['TL_PERMISSIONS'][] = 'videobox_operations';

// InsertTag Hook
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = ['Laemmi\Videobox\VideoBoxHelpers', 'replaceVideoBoxInsertTags'];

// Videotypes Array
$GLOBALS['VIDEOBOX']['VideoType'] = [];

/**
 * Add youtube videotype. This is how the array should look like if you're adding an additional video type:
$GLOBALS['VIDEOBOX']['VideoType']['videotype_name'] = array('Class', 'Method');
 */
$GLOBALS['VIDEOBOX']['VideoType']['youtube'] = ['Laemmi\Videobox\YouTubeFrontend', 'parseVideo'];

// Vimeo
$GLOBALS['VIDEOBOX']['VideoType']['vimeo'] = ['Laemmi\Videobox\VimeoFrontend', 'parseVideo'];
