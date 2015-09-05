<?php
class Rabee3_StoreLocator_Block_Main extends Mage_Core_Block_Template
{
	public function _construct() {
	}

	public function getStores()
	{
		$stores = Mage::getModel('storelocator/locations')->getCollection()
						->addFieldToFilter('status', array('eq' => 1));

		if($stores) {
			return json_encode($stores->getData());
		} else {
			return json_encode(['message' => 'no results']);
		}
	}
}
