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

	public function zipcodestoresAction()
	{
		$zipCode = $this->getRequest()->getParam('zipcode');
		if(strlen($zipCode) == 5) {
			$stores = Mage::getModel('storelocator/locations')->getCollection()
							->addFieldToFilter('status', array('eq' => 1))
							->addFieldToFilter('zipcode', array('eq' => $zipCode));

			if($stores) {
				echo json_encode($stores->getData());
			} else {
				echo json_encode(['message' => 'no results']);
			}
		} else {
			echo json_encode(['message' => 'no results']);
		}
	}
}
