<?php

class Rabee3_StoreLocator_Block_Adminhtml_Locations_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form(array(
                                      'id' => 'edit_form',
                                      'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
                                      'method' => 'post',
        							  'enctype' => 'multipart/form-data'
                                   )
      );

      $fieldset = $form->addFieldset('locations_form', array('legend'=>Mage::helper('storelocator')->__('Location Information')));

      $fieldset->addField('name', 'text', array(
          'label'     => Mage::helper('storelocator')->__('Store Name'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'name',
      ));

      $fieldset->addField('address', 'textarea', array(
          'label'     => Mage::helper('storelocator')->__('Address'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'address',
      ));

      $fieldset->addField('zipcode', 'text', array(
          'label'     => Mage::helper('storelocator')->__('Zip Code'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'zipcode',
      ));

      $fieldset->addField('phone', 'text', array(
          'label'     => Mage::helper('storelocator')->__('Phone Number'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'phone',
      ));

      $fieldset->addField('longitude', 'text', array(
          'label'     => Mage::helper('storelocator')->__('Longitude'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'longitude',
      ));

      $fieldset->addField('latitude', 'text', array(
          'label'     => Mage::helper('storelocator')->__('Latitude'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'latitude',
      ));

      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('storelocator')->__('Status'),
          'name'      => 'status',
          'class'     => 'required-entry',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => 'Active',
              ),

              array(
                  'value'     => 0,
                  'label'     => 'Inactive',
              ),
          )
      ));

      if ( Mage::getSingleton('adminhtml/session')->getLocationsData() ) {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getLocationsData());
          Mage::getSingleton('adminhtml/session')->setLocationsData(null);
      } elseif ( Mage::registry('locations_data') ) {
          $form->setValues(Mage::registry('locations_data')->getData());
      }

      $form->setUseContainer(true);
      $this->setForm($form);
      return parent::_prepareForm();
  }
}
