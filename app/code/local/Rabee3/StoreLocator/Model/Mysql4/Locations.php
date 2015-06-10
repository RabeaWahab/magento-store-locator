<?php
class Rabee3_StoreLocator_Model_Mysql4_Locations extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('storelocator/locations', 'id');
    }
}