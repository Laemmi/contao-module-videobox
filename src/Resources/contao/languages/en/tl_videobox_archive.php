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
 * Legends
 */
$GLOBALS['TL_LANG']['tl_videobox_archive']['title_legend'] = 'Global archive settings';


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_videobox_archive']['title'] = array('Title','Please give the archive a title.');
$GLOBALS['TL_LANG']['tl_videobox_archive']['activeVideoTypes'] = array('Videotypes in this archive','Choose the videotypes you would like to enable for this archive.');
$GLOBALS['TL_LANG']['tl_videobox_archive']['allowedUserGroups'] = array('Permissions','The checked usergroups will have access to the videos in this archive in the dropdown, where you choose the videos from.');

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_videobox_archive']['editvideosettings'] = array('Edit settings', 'Edit the settings for the VideoBox archive with id %s');
$GLOBALS['TL_LANG']['tl_videobox_archive']['new']    = array('New VideoBox archive', 'Create a new VideoBox archive');
$GLOBALS['TL_LANG']['tl_videobox_archive']['edit']   = array('Edit VideoBox archive', 'Edit the VideoBox archive with id %s');
$GLOBALS['TL_LANG']['tl_videobox_archive']['copy']   = array('Copy VideoBox archive', 'Copy the VideoBox archive with id %s');
$GLOBALS['TL_LANG']['tl_videobox_archive']['delete'] = array('Delete VideoBox archive', 'Delete the VideoBox archive with id %s');
$GLOBALS['TL_LANG']['tl_videobox_archive']['show']   = array('Show details', 'Show the details of the VideoBox archive with id %s');