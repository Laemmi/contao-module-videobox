<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');
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
 * @since       10..03.16
 */

/**
 * Add palettes to tl_calendar_events
 */
$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['__selector__'][] = 'videobox_addvideo';
$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default'] = str_replace('addEnclosure;','addEnclosure;{videobox_legend:hide},videobox_addvideo;',$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default']);
$GLOBALS['TL_DCA']['tl_calendar_events']['subpalettes']['videobox_addvideo'] = 'videobox_video';

/**
 * Add fields to tl_calendar_events
 */
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['videobox_addvideo'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['videobox_addvideo'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'					  => array('submitOnChange'=>true)
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['videobox_video'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['videobox_video'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'		  => array('VideoBox_Helpers', 'getVideos'),
	'eval'					  => array('mandatory'=>true)
);