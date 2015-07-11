<?php
class Rabee3_StoreLocator_IndexController extends Mage_Core_Controller_Front_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}

	public function storesAction()
	{
		$stores = Mage::getModel('storelocator/locations')->getCollection()
						->addFieldToFilter('status', array('eq' => 1));

		if($stores) {
			echo json_encode($stores->getData());
		} else {
			echo json_encode(['message' => 'no results']);
		}
	}
}
