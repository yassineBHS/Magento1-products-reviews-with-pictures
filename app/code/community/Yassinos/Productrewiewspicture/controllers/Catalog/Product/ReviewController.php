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
 * Mage Adminhtml Catalog_Product_ReviewController Rewrite
 *
 * @category   Yassinos
 * @package    Yassinos_Productrewiewspicture
 * @author      Yassine BELHAJ SALAH <belhajsalahyassine@gmail.com>
 */

require_once(Mage::getModuleDir('controllers','Mage_Adminhtml').DS.'Catalog'.DS.'Product'.DS.'ReviewController.php');

class Yassinos_Productrewiewspicture_Catalog_Product_ReviewController extends Mage_Adminhtml_Catalog_Product_ReviewController {

    /**
     * Review Form save action
     *
     * @param NULL
     * @return NULL
     */
    public function saveAction() {
        if (($data = $this->getRequest()->getPost()) && ($reviewId = $this->getRequest()->getParam('id'))) {
            $review = Mage::getModel('review/review')->load($reviewId);
            $session = Mage::getSingleton('adminhtml/session');
            if (!$review->getId()) {
                $session->addError(Mage::helper('catalog')->__('The review was removed by another user or does not exist.'));
            } else {
                
                //Import review's picture if it's modified by admin
                try {
                    if (isset($_FILES['picture_url']['name']) && !empty($_FILES['picture_url']['name'])) {
                        try {
                            Mage::helper('productrewiewspicture')->getUploadReviewPicture();

                            $data['picture_url'] = $_FILES['picture_url']['name'];
                        } catch (Exception $e) {
                            $session->addError($e->getMessage());
                        }
                    } else {
                        $data['picture_url'] = $review->getPictureUrl();
                    }
                    $review->addData($data)->save();

                    $arrRatingId = $this->getRequest()->getParam('ratings', array());
                    $votes = Mage::getModel('rating/rating_option_vote')
                            ->getResourceCollection()
                            ->setReviewFilter($reviewId)
                            ->addOptionInfo()
                            ->load()
                            ->addRatingOptions();
                    foreach ($arrRatingId as $ratingId => $optionId) {
                        if ($vote = $votes->getItemByColumnValue('rating_id', $ratingId)) {
                            Mage::getModel('rating/rating')
                                    ->setVoteId($vote->getId())
                                    ->setReviewId($review->getId())
                                    ->updateOptionVote($optionId);
                        } else {
                            Mage::getModel('rating/rating')
                                    ->setRatingId($ratingId)
                                    ->setReviewId($review->getId())
                                    ->addOptionVote($optionId, $review->getEntityPkValue());
                        }
                    }

                    $review->aggregate();

                    $session->addSuccess(Mage::helper('catalog')->__('The review has been saved.'));
                } catch (Mage_Core_Exception $e) {
                    $session->addError($e->getMessage());
                } catch (Exception $e) {
                    $session->addException($e, Mage::helper('catalog')->__('An error occurred while saving this review.'));
                }
            }

            return $this->getResponse()->setRedirect($this->getUrl($this->getRequest()->getParam('ret') == 'pending' ? '*/*/pending' : '*/*/'));
        }
        $this->_redirect('*/*/');
    }

}
