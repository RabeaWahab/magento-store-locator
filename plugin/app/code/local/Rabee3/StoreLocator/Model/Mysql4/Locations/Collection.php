<?php
 
class Rabee3_StoreLocator_Model_Mysql4_Locations_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        //parent::__construct();
        $this->_init('storelocator/locations');
    }
}