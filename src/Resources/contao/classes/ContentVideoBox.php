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
 * @package     ContentVideoBox
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
 * Class ContentVideoBox
 */
class ContentVideoBox extends \ContentElement
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_videobox';

    /**
     * Generate module
     */
    protected function compile()
    {
        $objVideo = new VideoBoxElement((int) $this->videobox_video);
        $this->Template->element = $objVideo->generate();

        $this->Template->description = $this->videobox_description;
        $this->Template->float = in_array($this->videobox_floating, ['left', 'right']) ? sprintf(' float:%s;', $this->videobox_floating) : '';
    }
}
