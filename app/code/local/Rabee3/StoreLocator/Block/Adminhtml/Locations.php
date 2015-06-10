<?php
class Rabee3_StoreLocator_Block_Adminhtml_Locations extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. foo_bar/adminhtml_baz
        $this->_blockGroup = 'storelocator';
        $this->_controller = 'adminhtml_locations';
        $this->_headerText = $this->__('Store Locations');
         
        parent::__construct();
    }
}