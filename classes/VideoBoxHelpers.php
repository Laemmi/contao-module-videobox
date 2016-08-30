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
 * @package     VideoBoxHelpers
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
 * Use
 */
use Laemmi\Videobox\VideoBoxElement;

/**
 * Class VideoBoxHelpers
 */
class VideoBoxHelpers extends \Controller
{
	/**
	 * Load database object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('Database');
	}

/***********************************************************************************************************************/
/* FRONTEND
/***********************************************************************************************************************/
	
	/**
	 * Compile InsertTags
	 * @param string
	 * @return mixed
	 */
	public function replaceVideoBoxInsertTags($strTag)
	{
		// {{VIDEOBOX_NEWS::CONTAINERID}} 
		if(strpos($strTag, 'VIDEOBOX_NEWS::') !== false)
		{
			$arrData = explode('::', $strTag);
			$strID = $arrData[1];
			
			$objNews = $this->Database->prepare("SELECT videobox_video FROM tl_news WHERE videobox_addvideo=? AND id=?")
									  ->execute(1,$strID);
			
			if($objNews->numRows < 1) {
				return '';
			}
			
            $objVideo = new VideoBoxElement((int) $objNews->videobox_video);
			return $objVideo->generate();
		}
		
		// {{VIDEOBOX_EVENTS::CONTAINERID}} 
		if(strpos($strTag, 'VIDEOBOX_EVENTS::') !== false) {
			$arrData = explode('::', $strTag);
			$strID = $arrData[1];
			
			$objNews = $this->Database->prepare("SELECT videobox_video FROM tl_calendar_events WHERE videobox_addvideo=? AND id=?")
									  ->execute(1,$strID);
			
			if($objNews->numRows < 1) {
				return '';
			}

            $objVideo = new VideoBoxElement((int) $objNews->videobox_video);
            return $objVideo->generate();
		}
		
		// {{VIDEOBOX_STANDALONE::VIDEOID}}
		if(strpos($strTag, 'VIDEOBOX_STANDALONE::') !== false) {
			$arrData = explode('::', $strTag);
			
            $objVideo = new VideoBoxElement((int) $arrData[1]);
            return $objVideo->generate();		
		}
        
		return false;
	}

/***********************************************************************************************************************/
/* BACKEND
/***********************************************************************************************************************/
	
	/**
	 * List all the videos in a dropdown (to choose from in the backend)
	 * @return array
	 */
	public function getVideos()
	{
		$this->import('BackendUser', 'User');

		$groups = array();
	
		$objVideos = $this->Database->execute("SELECT v.id AS videoid, v.videotitle, a.title AS archivetitle, a.allowedUserGroups FROM tl_videobox v LEFT JOIN tl_videobox_archive a ON (a.id = v.pid) ORDER BY a.title");

		// build groups
		
 		while($objVideos->next()) {
			// show everything to admins
			if($this->User->isAdmin) {
				$groups[$objVideos->archivetitle][$objVideos->videoid] = $objVideos->videotitle . ' [ID: ' . $objVideos->videoid . ']';
				continue;
			}
			
			// if there is no usergroup allowed at all (empty blob)
			if(strlen($objVideos->allowedUserGroups) == 0) {
				continue;
			}
			
			// check whether the user is allowed to see the video
			if(count(array_intersect($this->User->groups, deserialize($objVideos->allowedUserGroups)))) {
				$groups[$objVideos->archivetitle][$objVideos->videoid] = $objVideos->videotitle . ' [ID: ' . $objVideos->videoid . ']';
			}
		}
		return $groups; 
	}

	/**
	 * Compile InsertTags
	 * @param object
	 * @param string
	 * @param array
	 */
	public function linkToSettings($dc)
	{
		// check wheter there has already been created a settings entry
		$objCheck = $this->Database->prepare("SELECT id FROM tl_videobox_settings WHERE pid=?")
								   ->execute($dc->id);

        $params = [
            'do'    => 'videobox',
            'table' => 'tl_videobox_settings',
            'rt'    => REQUEST_TOKEN,
        ];
		// no entry yet - redirect to the create page
		if($objCheck->numRows < 1) {
            $params['act']  = 'create';
            $params['mode'] = '2';
            $params['pid']  = $dc->id;
			$this->redirect('contao/main.php?' . http_build_query($params));
		}

        $params['act'] = 'edit';
        $params['id']  = $objCheck->id;
		// else redirect to the existing entry 
		$this->redirect('contao/main.php?' . http_build_query($params));
	}
    
    /**
     * Prepare video template data
     * @param int video id
     * @param int jumpTo page
     * @return array
     */
    public function prepareVideoTemplateData($intVideoId, $intJumpTo=false)
    {
        $arrReturn = array();
        $objVideo = new VideoBoxElement($intVideoId);
        $arrReturn['video'] = $objVideo->generate();
        $arrReturn['videoData'] = $objVideo->getData();
        $arrReturn['title'] = $objVideo->videotitle;
        
        if ($intJumpTo) {
            // jumpTo gets cached automatically
            $objJumpTo = $this->Database->prepare('SELECT id,alias FROM tl_page WHERE id=?')->execute($intJumpTo);
            $arrReturn['href']  = ampersand($this->generateFrontendUrl($objJumpTo->row(), '/video/' . ((!$GLOBALS['TL_CONFIG']['disableAlias'] && $objVideo->alias != '') ? $objVideo->alias : $objVideo->videoid)));
        }

        // thumb
        if ($objVideo->thumb) {
            $objImgData = new stdClass();
            $arrItem = array_merge($arrReturn['videoData'], array
            (
                'singleSRC' => $objVideo->thumb
            ));
            
            $this->addImageToTemplate($objImgData, $arrItem);
            $arrReturn['imgData'] = $objImgData;
        }
        
        return $arrReturn;
    }
}