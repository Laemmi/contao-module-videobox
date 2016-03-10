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
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_legend'] = 'Youtube video';

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_template'] = array('Template','Choose the template for Youtube videos.');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_size'] = array('Size','Choose the size for the video (width x height).');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_rel'] = array('Show related videos','Sets whether the player should load related videos once playback of the initial video starts.');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_autoplay'] = array('Autoplay','Sets whether or not the initial video will autoplay when the player loads.');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_loop'] = array('Loop the video','This will cause the player to play the video again and again.');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_border'] = array('Show border','Setting to "Yes" enables a border around the entire video player. Consider the colors!');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_color1'] = array('Color 1','This color is the <strong>primary</strong> border color.');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_color2'] = array('Color 2','This color is the <strong>secondary</strong> border color <strong>and</strong> at the same time the video control bar background color.');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_start'] = array('Where should the video start playing?','This parameter causes the player to begin playing the video at the given number of seconds from the start of the video. Note that the player will look for the closest keyframe to the time you specify. This means sometimes the play head may seek to just before the requested time, usually no more than ~2 seconds.');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_fs'] = array('Allow fullscreen','This enables the fullscreen button.');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_hd'] = array('Show video in HD','This has of course no effect if an HD version of the video is not available.');
$GLOBALS['TL_LANG']['tl_videobox_settings']['youtube_showinfo'] = array('Show video information','Display information like the video title and rating before the video starts playing.');