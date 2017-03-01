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
 * Product Review Pictures Observer
 *
 * @category   Yassinos
 * @package    Yassinos_Productrewiewspicture
 * @author      Yassine BELHAJ SALAH <belhajsalahyassine@gmail.com>
 */

class Yassinos_Productrewiewspicture_Model_Observer {
    
    /**
     * Add custom image column to Review grid
     *
     * @param Varien_Object $observer
     * @return Mage_Adminhtml_Block_Review_Grid
     */
    public function appendCustomField ($observer) 
    {
        $grid = $observer->getBlock();
        
        if ($grid instanceof Mage_Adminhtml_Block_Review_Grid) 
        {
            $grid->addColumnAfter('picture', array(
                'header'    => 'Review Picture',
                'type'      => 'text',
                'index'     => 'picture',
                'renderer' => 'Yassinos_Productrewiewspicture_Block_Adminhtml_Template_Grid_Renderer_Image'
            ), 'detail');
        }        
    }
    
    /**
     * Add custom image field and image visualzation to Review edit Form
     *
     * @param Varien_Object $observer
     * @return Mage_Adminhtml_Block_Review_Edit_Form
     */
    public function appendCustomColumn ($observer) 
    {        
        $block = $observer->getEvent()->getBlock();
        if ($block->getType() == 'adminhtml/review_edit_form') 
        {   $picturesLocation = Mage::helper('productrewiewspicture')->getPicturesLocation();
            $mediaUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
        
            $review = Mage::registry('review_data');
            
            $form = $block->getForm();
            
            $form->setEnctype('multipart/form-data');
            
            $fieldset = $form->getElement('review_details');
            
            $field = $fieldset->addField('picture_visulize', 'hidden', array(
                'name'      => 'picture_url',
            ));
            
            $picture_path = '';
            if($name = $review->getPictureUrl()) {
            $picture_path =  $mediaUrl.$picturesLocation.DS.$name;
            $field->setAfterElementHtml(                    
                "<img src='$picture_path' style='max-height : 150px'/> "
            );
            }
            
            $fieldset->addField('picture_url', 'image', array(
                'name'      => 'picture_url',
                'label'     => Mage::helper('adminhtml')->__('review picture'),
                'title'     => Mage::helper('adminhtml')->__('review picture'),
                'value'     => $picture_path,
            ));
            
        } 
    } 
}