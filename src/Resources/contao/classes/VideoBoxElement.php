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
 * @package     VideoBoxElement
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
 * Class VideoBoxElement
 */
class VideoBoxElement extends \Contao\System
{
    /**
     * Data table
     * @var string
     */
    public $strTable = '';

    /**
     * Video type
     * @var string
     */
    public $strVideoType = '';

    /**
     * Data array
     * @var array
     */
    public $arrData = [];

    /**
     * Video object
     * @var object
     */
    public $objVideo;

    /**
     * Initialize the object
     * @param mixed either the video ID or its alias
     * @param string
     * @param string
     */
    public function __construct($varId, $strTable = 'tl_videobox', $strVideoType = '')
    {
        parent::__construct();

        // set vars
        $this->strTable = $strTable;
        $this->strVideoType = $strVideoType;

        $this->import('Database');

        // SQL - provide data for other tables too
        if ($this->strTable == 'tl_videobox') {
            $strSQL =   'SELECT
							v.*,a.*,s.*,v.id as videoid
						FROM
						(
							tl_videobox v 
						LEFT JOIN
							tl_videobox_archive a
						ON
							v.pid = a.id
						)
						LEFT JOIN
							tl_videobox_settings s
						ON
							a.id = s.pid
						WHERE
							v.id=? OR v.alias=?';
        } else {
            $strSQL = 'SELECT * FROM ' . $this->strTable . ' WHERE id=? OR alias=?';
        }

        // get data
        $objData = $this->Database->prepare($strSQL)
            ->limit(1)
            ->execute($varId, $varId);

        if (!$objData->numRows) {
            throw new \Exception('The video with id or alias "' . $varId . '" does not exist!');
        }

        // set data
        $this->arrData = $objData->fetchAssoc();

        // set videotype
        if (!$this->strVideoType) {
            $this->strVideoType = $this->arrData['videotype'];
        }
    }


    /**
     * Get the data
     * @return array
     */
    public function getData()
    {
        return $this->arrData;
    }

    /**
     * Return the video object as a string
     * @return string
     */
    public function generate()
    {
        // HOOK: processVideoData
        if (isset($GLOBALS['VIDEOBOX']['VideoType']) && is_array($GLOBALS['VIDEOBOX']['VideoType']) && array_key_exists($this->strVideoType, $GLOBALS['VIDEOBOX']['VideoType'])) {
            $class = $GLOBALS['VIDEOBOX']['VideoType'][$this->strVideoType][0];
            $method = $GLOBALS['VIDEOBOX']['VideoType'][$this->strVideoType][1];

            $this->import($class);

            return $this->$class->$method($this->arrData);
        }

        // other than that, there's no videobox hook for this type!
        throw new \Exception('There is no valid video type hook for the video type "' . $this->strVideoType . '"!');
    }
}
