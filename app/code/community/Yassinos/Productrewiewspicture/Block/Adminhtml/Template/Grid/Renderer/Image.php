<?php  

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This file is a limited source, part of the Magento module named "Yassinos_productreviewspicture" 
 * dedicated to add an image fields to the review form in the product pages.
 * The image entered by the client can be modified from the form page from the backoffice 
 * by the admin.
 * The images will be imported into the servers under the media folder in a location 
 * chosen by the administrator from the back office.
 * Enabling and disabling module functionality is also manageable, Do not hesitate to 
 * contact us on belhajsalahyassine@gmail.com in case of need, interrogation,
 * rectification and others ...
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category   Yassinos
 * @package    Yassinos_Productrewiewspicture
 * @copyright  Copyright (c) Yassine BELHAJ SALAH . (http://www.yassine-belhajsalah.com)
 */

/**
 * html picture review content
 *
 * @category   Yassinos
 * @package    Yassinos_Productrewiewspicture
 * @author      Yassine BELHAJ SALAH <belhajsalahyassine@gmail.com>
 */

class Yassinos_Productrewiewspicture_Block_Adminhtml_Template_Grid_Renderer_Image extends 
Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Retrive review picture grid html block
     *
     * @param Varien_Object $row
     * @return html
     */
    public function render(Varien_Object $row)
    {
        $picturesLocation = Mage::helper('productrewiewspicture')->getPicturesLocation();
        $mediaUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        
        if ($picture_name = $row->getPictureUrl())
        return Mage::helper('productrewiewspicture')
                ->getImageHtmlAction($mediaUrl . $picturesLocation .DS.$picture_name,'50px');
        else return '';
    }
}