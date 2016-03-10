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
 * @since       10.03.16
 */

/**
 * Table tl_videobox 
 */
$GLOBALS['TL_DCA']['tl_videobox'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_videobox_archive',
		'enableVersioning'            => true
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('sorting'),
			'headerFields'            => array('title', 'activeVideoTypes', 'allowedUserGroups'),
			'panelLayout'             => 'filter;search,limit',
			'child_record_callback'   => array('tl_videobox', 'compileVideos')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_videobox']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_videobox']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.gif'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_videobox']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_videobox']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_videobox']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	
 	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('videotype'),
		'default'                     => '{title_legend},videotitle,alias,videotype;',
		'youtube'					  => '{title_legend},videotitle,alias,videotype;{youtube_legend},thumb,size,descr,youtube_id;'
	),
	
	// Fields
	'fields' => array
	(
		'videotitle' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_videobox']['videotitle'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
		),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_videobox']['alias'],
			'exclude'                 => true,
			'inputType'               => 'text',
            'eval'                    => array('tl_class'=>'w50', 'doNotCopy'=>true),
			'save_callback'           => array
			(
                array('tl_videobox', 'generateAlias')
            )
		),
		'videotype' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_videobox']['videotype'],
			'exclude'                 => true,
			'default'				  => 'youtube',
			'inputType'               => 'select',
			'default'				  => '-',				
			'options_callback'		  => array('tl_videobox', 'getVideoTypes'),
			'eval'                    => array('mandatory'=>true, 'submitOnChange'=>true,'includeBlankOption'=>true, 'tl_class'=>'clr')
		),
        'thumb' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox']['thumb'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType'=>'radio', 'filesOnly'=>true, 'files'=>true, 'extensions'=>'jpg,jpeg,png,gif')
        ),
        'size' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox']['size'],
            'exclude'                 => true,
            'inputType'               => 'imageSize',
            'options'                 => $GLOBALS['TL_CROP'],
            'reference'               => &$GLOBALS['TL_LANG']['MSC'],
            'eval'                    => array('rgxp'=>'digit', 'nospace'=>true)
        ),
        'descr' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_videobox']['descr'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => array('rte'=>'tinyMCE')
        ),
		'youtube_id' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_videobox']['youtube_id'],
			'exclude'                 => true,
			'inputType'               => 'text'
		)
	)
);


// Vimeo ####
$GLOBALS['TL_DCA']['tl_videobox']['palettes'] += array(
    'vimeo' => '{title_legend},videotitle,videotype;{vimeo_legend},vimeo_id;'
);

$GLOBALS['TL_DCA']['tl_videobox']['fields'] += array(
    'vimeo_id' => array
    (
        'label'                   => &$GLOBALS['TL_LANG']['tl_videobox']['vimeo_id'],
        'exclude'                 => true,
        'inputType'               => 'text'
    )
);

/**
 * Use
 */
use Laemmi\Videobox\VideoBoxElement;

/**
 * Class tl_videobox
 */
class tl_videobox extends \Backend
{
	/**
	 * Method to list all video types that have been allowed for this archive
	 * @return array
	 */
	public function getVideoTypes()
	{
		$objPID = $this->Database->prepare("SELECT pid FROM tl_videobox WHERE id=?")
								 ->execute($this->Input->get('id'));
								 
		$objArchive = $this->Database->prepare("SELECT activeVideoTypes as aVT FROM tl_videobox_archive WHERE id=?")
									 ->execute($objPID->pid);
									 
		// if there are no video types allowed return
		if(strlen($objArchive->aVT) == 0) {
			return;
		}
		
		$arrAllowedVidTypes = deserialize($objArchive->aVT);		
		$arrTypes = array();
		
		foreach(array_keys($GLOBALS['VIDEOBOX']['VideoType']) as $type)
		{
			if(in_array($type, $arrAllowedVidTypes))
			{
				$arrTypes[$type] = $GLOBALS['TL_LANG']['VideoTypes'][$type];
			}
		}
		
		return $arrTypes;
	}
	
	/**
	 * Compile Videos for the backend view
	 * @param array
	 * @return string
	 */
	public function compileVideos($arrRow)
	{
	    $objVideo = new VideoBoxElement((int) $arrRow['id']);
		return '
		<div class="cte_type"><strong>' . $arrRow['videotitle'] . '</strong></div>
		<div class="limit_height' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? ' h64' : '') . ' block">
		' . $objVideo->generate() . '
		</div>' . "\n";
	}
    
    
    /**
     * Auto-generate a video alias if it has not been set yet
     * @param mixed
     * @param DataContainer
     * @return string
     */
    public function generateAlias($varValue, \DataContainer $dc)
    {
        // Generate an alias if there is none
        if ($varValue == '') {
            $varValue = standardize($this->restoreBasicEntities($dc->activeRecord->videotitle));
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_videobox WHERE alias=?")
                                   ->execute($varValue);
                                   
        // if the ID matches the current one editing, everything is perfect
        if ($objAlias->id == $dc->id) {
            return $varValue;
        }

        // Check whether the page alias exists
        if ($objAlias->numRows) {
            throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
        }

        return $varValue;
    }
}