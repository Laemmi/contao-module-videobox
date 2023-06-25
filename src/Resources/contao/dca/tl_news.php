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
 * Add palettes to tl_news
 */
$GLOBALS['TL_DCA']['tl_news']['palettes']['__selector__'][] = 'videobox_addvideo';
$GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace('addEnclosure;', 'addEnclosure;{videobox_legend:hide},videobox_addvideo;', $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);
$GLOBALS['TL_DCA']['tl_news']['subpalettes']['videobox_addvideo'] = 'videobox_video';

/**
 * Add fields to tl_news
 */
$GLOBALS['TL_DCA']['tl_news']['fields']['videobox_addvideo'] =
[
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['videobox_addvideo'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => ['submitOnChange' => true]
];

$GLOBALS['TL_DCA']['tl_news']['fields']['videobox_video'] =
[
    'label'                   => &$GLOBALS['TL_LANG']['tl_news']['videobox_video'],
    'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => ['Laemmi\Videobox\VideoBoxHelpers', 'getVideos'],
    'eval'                    => ['mandatory' => true]
];
