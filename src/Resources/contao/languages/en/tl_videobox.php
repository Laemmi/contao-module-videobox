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
 * @package     languages
 * @author      Michael Lämmlein <laemmi@spacerabbit.de>
 * @copyright   ©2016 laemmi
 * @license     http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version     1.0.0
 * @since       10..03.16
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_videobox']['videotitle'] = array('Video title', 'Please give your video a title.');
$GLOBALS['TL_LANG']['tl_videobox']['alias'] = array('Video alias', 'Please give your video an alias or let it generate automatically from the title.');
$GLOBALS['TL_LANG']['tl_videobox']['videotype'] = array('Videotype', 'Please choose the type of video you want to specify.');
$GLOBALS['TL_LANG']['tl_videobox']['thumb'] = array('Preview image', 'Choose your preview image from the system.');
$GLOBALS['TL_LANG']['tl_videobox']['descr'] = array('Description', 'Enter a description for this video.');
$GLOBALS['TL_LANG']['tl_videobox']['size'] = array('Thumbnail size', 'Choose the thumbnail size.');
$GLOBALS['TL_LANG']['tl_videobox']['youtube_id'] = array('Youtube-ID', 'Enter the ID of your Youtube video. The ID is the <strong>bold</strong> part: http://www.youtube.com/watch?v=<strong>SGeZYednWtI</strong>');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_videobox']['title_legend'] = 'Default settings';
$GLOBALS['TL_LANG']['tl_videobox']['youtube_legend'] = 'Youtube video';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_videobox']['new']    = array('New video', 'Create a new video');
$GLOBALS['TL_LANG']['tl_videobox']['edit']   = array('Edit video', 'Edit the video with id %s');
$GLOBALS['TL_LANG']['tl_videobox']['copy']   = array('Copy video', 'Copy the video with id %s');
$GLOBALS['TL_LANG']['tl_videobox']['cut']   = array('Move video', 'Move the video with id %s');
$GLOBALS['TL_LANG']['tl_videobox']['delete'] = array('Delete video', 'Delete the video with id %s');
$GLOBALS['TL_LANG']['tl_videobox']['show']   = array('Show details', 'Show the details of the video with id %s');