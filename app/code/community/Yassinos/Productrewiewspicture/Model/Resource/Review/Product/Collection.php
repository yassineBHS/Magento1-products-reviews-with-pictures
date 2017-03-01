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
 * Model Resource Review Product Collection rewrite
 *
 * @category   Yassinos
 * @package    Yassinos_Productrewiewspicture
 * @author      Yassine BELHAJ SALAH <belhajsalahyassine@gmail.com>
 */

class Yassinos_Productrewiewspicture_Model_Resource_Review_Product_Collection extends 
Mage_Review_Model_Resource_Review_Product_Collection
{
    /**
     * join fields to entity
     *
     * @return Mage_Review_Model_Resource_Review_Product_Collection
     */
    protected function _joinFields()
    {
        $reviewTable = Mage::getSingleton('core/resource')->getTableName('review/review');
        $reviewDetailTable = Mage::getSingleton('core/resource')->getTableName('review/review_detail');

        $this->addAttributeToSelect('name')
            ->addAttributeToSelect('sku');
        //add picture_url to the grid collection
        $this->getSelect()
            ->join(array('rt' => $reviewTable),
                'rt.entity_pk_value = e.entity_id',
                array('rt.review_id', 'review_created_at'=> 'rt.created_at', 'rt.entity_pk_value', 'rt.status_id'))
            ->join(array('rdt' => $reviewDetailTable),
                'rdt.review_id = rt.review_id',
                array('rdt.title','rdt.nickname', 'rdt.detail', 'rdt.customer_id', 'rdt.store_id', 'rdt.picture_url'));
        return $this;
    }
}

