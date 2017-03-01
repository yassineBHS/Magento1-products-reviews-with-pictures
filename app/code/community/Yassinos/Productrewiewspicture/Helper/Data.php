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
 * Product Review Pictures Helper
 *
 * @category   Yassinos
 * @package    Yassinos_Productrewiewspicture
 * @author      Yassine BELHAJ SALAH <belhajsalahyassine@gmail.com>
 */

class Yassinos_Productrewiewspicture_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Check if posting pictures with reviews is allowed
     * 
     * @return Boolean
     */
    public function isAllowedPosting()
    {
       return Mage::getStoreConfig('productrewiewspicture_options/review_pictures/enable_pictures');
    }
    
    /**
     * Return pictures's directory name
     * 
     * @return String
     */
    public function getPicturesLocation()
    {
       $location = Mage::getStoreConfig('productrewiewspicture_options/review_pictures/pictures_location');
       return ($location) ? $location : 'product rewiews pictures';
    }
    /**
     * Retrive block html picture
     *
     * @param String $row
     * @param String $height
     * @return html
     */
    public function getImageHtmlAction($url,$height)
    {
        return "<img src='".$url."' style='max-height : ".$height."'/> ";
    }
    
    /**
     * Upload review's picture
     */
    public function getUploadReviewPicture()
    {
        $uploader = new Varien_File_Uploader('picture_url');

        $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));

        $uploader->setAllowRenameFiles(false);

        $uploader->setFilesDispersion(false);
        
        $picturesLocation = $this->getPicturesLocation();
        
        $mediaUrl = Mage::getBaseDir('media');

        $path = $mediaUrl . DS . $picturesLocation . DS;

        $uploader->save($path, $_FILES['picture_url']['name']);
    }
}
	 