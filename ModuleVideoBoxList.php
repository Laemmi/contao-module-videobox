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
 * @package     ModuleVideoBoxList
 * @author      Michael Lämmlein <laemmi@spacerabbit.de>
 * @copyright   ©2016 laemmi
 * @license     http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version     1.0.0
 * @since       10..03.16
 */

/**
 * Class ModuleVideoBoxList 
 */
class ModuleVideoBoxList extends Module
{
    
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_videobox_list';


	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### VIDEOBOX LIST ###';

			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}
        
        // overwrite the module template
        if ($this->videobox_tpl_list)
        {
            $this->strTemplate = $this->videobox_tpl_list;
        }

		return parent::generate();
	}
	
	
    /**
     * Generate the module
     */
	protected function compile()
	{
        $arrArchives = deserialize($this->videobox_archives, true);
        
        if (empty($arrArchives))
        {
            return '';
        }
        
        // basic template variables
        $this->Template->hasVideos = true;
        
        // prepare the sql
        $strSQL = '';
        if ($this->videobox_sql)
        {
            $strSQL = ' ' . trim($this->videobox_sql);
        }
        
        $intTotal = (int) $this->Database->query('SELECT COUNT(id) AS total FROM tl_videobox WHERE pid IN (' . implode(',', $arrArchives) . ')' . $strSQL)->total;
        
        if ($intTotal == 0)
        {
            $this->Template->hasVideos = false;
            $this->Template->msg = $GLOBALS['TL_LANG']['VideoBox']['no_videos'];
            return;
        }
        
        $limit = $intTotal;
        $offset = 0;

        // Pagination
        if ($this->perPage > 0)
        {
            $page = $this->Input->get('page') ? $this->Input->get('page') : 1;
            $offset = ($page - 1) * $this->perPage;
            $limit = min($this->perPage + $offset, $intTotal);

            $objPagination = new Pagination($intTotal, $this->perPage);
            $this->Template->pagination = $objPagination->generate("\n  ");
        }

        // videobox statement
        $objVideosStmt = $this->Database->prepare('SELECT id FROM tl_videobox WHERE pid IN (' . implode(',', $arrArchives) . ')' . $strSQL);

        // Limit the result
        if (isset($limit))
        {
            $objVideosStmt->limit($limit, $offset);
        }
        
        $objVideos = $objVideosStmt->execute();
        $arrVideos = array();
        $count = 0;
        $this->import('VideoBox_Helpers', 'VBHelper');
        
        while ($objVideos->next())
        {
            $arrVideoData = $this->VBHelper->prepareVideoTemplateData($objVideos->id, $this->videobox_jumpTo);
            $arrVideos[$objVideos->id] = array_merge($arrVideoData, array
            (
                'count'    => ++$count,
                'cssClass' => (($count == 1) ? ' first' : '') . (($count == $limit) ? ' last' : '') . ((($count % 2) == 0) ? ' odd' : ' even')
                
            ));
        }
        
        $this->Template->videos = $arrVideos;
	}
}