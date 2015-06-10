<?php
class Rabee3_StoreLocator_Block_Adminhtml_Locations_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'storelocator';
        $this->_controller = 'adminhtml_locations';
        
        $this->_updateButton('save', 'label', Mage::helper('storelocator')->__('Save Location'));
        $this->_updateButton('delete', 'label', Mage::helper('storelocator')->__('Delete Location'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('locations_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'locations_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'locations_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('locations_data') && Mage::registry('locations_data')->getId() ) {
            return Mage::helper('storelocator')->__("Edit Location '%s'", $this->htmlEscape(Mage::registry('locations_data')->getTitle()));
        } else {
            return Mage::helper('storelocator')->__('Add Location');
        }
    }
}