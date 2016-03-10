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
 * Table tl_module 
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['videobox_list']			= '{title_legend},name,headline,type;{config_legend},videobox_archives,videobox_jumpTo,videobox_sql,perPage;{template_legend},videobox_tpl_list;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['videobox_reader']		    = '{title_legend},name,headline,type;{template_legend},videobox_tpl_reader;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['videobox_archives'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['videobox_archives'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_videobox_archive.title',
	'eval'                    => array('mandatory'=>true, 'multiple'=>true)
);
$GLOBALS['TL_DCA']['tl_module']['fields']['videobox_jumpTo'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['videobox_jumpTo'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'eval'                    => array('mandatory'=>true, 'fieldType'=>'radio')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['videobox_sql'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['videobox_sql'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'eval'                    => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['videobox_tpl_list'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['videobox_tpl_list'],
	'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('tl_module_videobox', 'getVideoBoxTemplates'),
	'eval'                    => array('tl_class'=>'w50')
);
$GLOBALS['TL_DCA']['tl_module']['fields']['videobox_tpl_reader'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['videobox_tpl_reader'],
	'exclude'                 => true,
    'inputType'               => 'select',
    'options_callback'        => array('tl_module_videobox', 'getVideoBoxTemplates'),
	'eval'                    => array('tl_class'=>'w50')
);


class tl_module_videobox extends Backend
{
    
    /**
     * Initialize the object
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    
    /**
     * Return all videobox templates as array
     * @param DataContainer
     * @return array
     */
    public function getVideoBoxTemplates(DataContainer $dc)
    {
        $intPid = $dc->activeRecord->pid;

        if ($this->Input->get('act') == 'overrideAll')
        {
            $intPid = $this->Input->get('id');
        }

        return $this->getTemplateGroup('mod_videobox_', $intPid);
    }
}
