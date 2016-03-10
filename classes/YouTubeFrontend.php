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
 * @package     YouTube
 * @author      Michael Lämmlein <laemmi@spacerabbit.de>
 * @copyright   ©2016 laemmi
 * @license     http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version     1.0.0
 * @since       10.03.16
 */

/**
 * Namespace
 */
namespace Laemmi\Videobox;

/**
 * Class YouTubeFrontend
 */
class YouTubeFrontend extends \Frontend
{
	/**
	 * Youtube URL
	 * @var string
	 */
	public $strYoutubeUrl = '';
	
	/**
	 * Youtube URL
	 * @var string
	 */
	public $strTemplate = '';
	
	/**
	 * Data array
	 * @var array
	 */
	public $arrData = array();
	
	/**
	 * Parse the array data and prepare for the Youtube video
	 * @param array
	 * @return array
	 */
	public function parseVideo($arrDBData)
	{
		// set template
		$this->strTemplate = (strlen($arrDBData['youtube_template'])) ? $arrDBData['youtube_template'] : 'videobox_youtube';
		
		// pass on the database row unchanged
		$this->arrData['dbRow'] = $arrDBData;
		
		$this->arrData['id'] = 'video_' . $arrDBData['videoid'] . '_' . md5(uniqid(mt_rand(), true));
		$this->arrData['timestamp'] = $arrDBData['tstamp'];
		$this->arrData['video_title'] = $arrDBData['videotitle'];
		$this->arrData['archive_title'] = $arrDBData['title'];
		
		// size
		if(!strlen($arrDBData['youtube_size'])) {
			$arrSize = array(425,344);
		} else {
			$arrSize = deserialize($arrDBData['youtube_size']);
		}
		
		$this->arrData['width'] = $arrSize[0];
		$this->arrData['height'] = $arrSize[1];
		
		// Youtube url...what a long chain again...copy&paste to the fullest!
		$arrUrlData = array();

		// rel
		if ($arrDBData['youtube_rel']) {
			$arrUrlData['rel'] = 1;
		} else {
			$arrUrlData['rel'] = 0;
		}

		// autoplay
		if ($arrDBData['youtube_autoplay'] && TL_MODE == 'FE')
			$arrUrlData['autoplay'] = 1;

		// loop
		if ($arrDBData['youtube_loop'])
			$arrUrlData['loop'] = 1;

		// border
		if ($arrDBData['youtube_border'])
			$arrUrlData['border'] = 1;

		// color1
		if ($arrDBData['youtube_color1'])
			$arrUrlData['color1'] = '0x' . $arrDBData['youtube_color1'];
		
		// color2
		if ($arrDBData['youtube_color2'])
			$arrUrlData['color2'] = '0x' . $arrDBData['youtube_color2'];

		// start
		if ($arrDBData['youtube_start'])
			$arrUrlData['start'] = '0x' . $arrDBData['youtube_start'];
		
		// fullscreen
		if ($arrDBData['youtube_fs'])
			$arrUrlData['fs'] = 1;

		// hd
		if ($arrDBData['youtube_hd'])
			$arrUrlData['hd'] = 1;

		// showinfo
		if ($arrDBData['youtube_showinfo'])
			$arrUrlData['showinfo'] = 1;	
		
		
		$this->arrData['urlParams']		= $arrUrlData;
		$this->arrData['youtubelink']	= 'http://www.youtube.com/embed/' . $arrDBData['youtube_id'] . self::generateQueryString($arrUrlData);

		// usability
		$this->arrData['noscript'] = specialchars(sprintf($GLOBALS['TL_LANG']['VideoBox']['youtube_noscript'], $arrDBData['videotitle']));
		$this->arrData['noflash'] = specialchars(sprintf($GLOBALS['TL_LANG']['VideoBox']['youtube_noflash'], $arrDBData['videotitle']));

		// Template
		$objTemplate = new \FrontendTemplate($this->strTemplate);
		$objTemplate->setData($this->arrData);
		return $objTemplate->parse();
	}


	/**
	 * Generate youtube query string
	 * @param array
	 * @return string
	 */
	public static function generateQueryString($arrData)
	{
		$total = count($arrData);
		
		if ($total < 1) {
			return '';
		}
		
		$strQuery = '';
		$i = 0;
		
		foreach($arrData as $param => $value) {
			$strQuery .= (($i == 0) ? '?' : '&') . $param . '=' . $value;
			$i++;
		}
		
		// encode entities because the url is being used in html
		return specialchars($strQuery);
	}
}