<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * xmstock module
 *
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */

defined('XOOPS_ROOT_PATH') || exit('Restricted access');

xoops_load('XoopsFormSelect');

/**
 * A select field with area
 */
class XmstockFormSelectArea extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string  $caption Caption
     * @param string  $name    "name" attribute
     * @param mixed   $value   Pre-selected value (or array of them).
     *                         Legal are all 2-letter country codes (in capitals).
	 * @param boolean $efl     If true added an empty first line 
     * @param int     $size    Number or rows. "1" makes a drop-down-list
     */
    public function __construct($caption, $name, $value = null, $efl = false, $size = 1)
    {
        parent::__construct($caption, $name, $value, $size);
        $this->addOptionArray(XmstockUtility::getAreaList($efl));
    }
}

/**
 * A select field with output
 */
class XmstockFormSelectOutput extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string  $caption Caption
     * @param string  $name    "name" attribute
     * @param mixed   $value   Pre-selected value (or array of them).
     *                         Legal are all 2-letter country codes (in capitals).
	 * @param boolean $efl     If true added an empty first line 
     * @param int     $size    Number or rows. "1" makes a drop-down-list
     */
    public function __construct($caption, $name, $value = null, $efl = false, $size = 1)
    {
        parent::__construct($caption, $name, $value, $size);
        $this->addOptionArray(XmstockUtility::getOutputList($efl));
    }
}
/**
 * A select field with article
 */
class XmstockFormSelectArticle extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string  $caption Caption
     * @param string  $name    "name" attribute
     * @param mixed   $value   Pre-selected value (or array of them).
     *                         Legal are all 2-letter country codes (in capitals).
	 * @param boolean $efl     If true added an empty first line 
     * @param int     $size    Number or rows. "1" makes a drop-down-list
     */
    public function __construct($caption, $name, $value = null, $efl = false, $size = 1)
    {
        parent::__construct($caption, $name, $value, $size);
		xoops_load('utility', 'xmarticle');
        $this->addOptionArray(XmarticleUtility::getArticleList($efl));
    }
}


