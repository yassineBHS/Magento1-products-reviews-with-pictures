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

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

/*
 * add picture_url to review_detail table
 */
$installer->getConnection()
->addColumn($installer->getTable('review/review_detail'),'picture_url', array(
    'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
    'nullable'  => false,
    'length'    => 255,
    'after'     => null, // column name to insert new column after
    'comment'   => 'Picture'
    )); 
$installer->endSetup();
	 