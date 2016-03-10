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
 * Add palettes to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['videobox'] = '{type_legend},type,headline;{videobox_legend},videobox_video,videobox_description,videobox_floating;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Add fields to tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['videobox_video'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['videobox_video'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'		  => array('VideoBox_Helpers', 'getVideos'),
	'eval'					  => array('mandatory'=>true)
);

$GLOBALS['TL_DCA']['tl_content']['fields']['videobox_description'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['videobox_description'],
	'exclude'                 => true,
	'inputType'               => 'textarea',
	'eval'					  => array('rte'=>'tinyMCE')
);

$GLOBALS['TL_DCA']['tl_content']['fields']['videobox_floating'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['videobox_floating'],
	'exclude'                 => true,
	'inputType'               => 'radioTable',
	'options'                 => array('above', 'left', 'right', 'below'),
	'eval'                    => array('cols'=>4),
	'reference'               => &$GLOBALS['TL_LANG']['MSC']
);