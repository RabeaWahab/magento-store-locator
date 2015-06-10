<?php
class Rabee3_StoreLocator_Adminhtml_LocationsController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
	{
		$this->loadLayout();
		$this->renderLayout();
	}

	public function newAction() {
		$this->_redirect('*/*/edit');
		return;
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('storelocator/locations')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('locations_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('storelocator/locations');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('storelocator/adminhtml_locations_edit'));
			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('storelocator')->__('Location does not exist'));
			$this->_redirect('*/*/');
		}
	}

	public function saveAction()
	{
	    $data = $this->getRequest()->getPost();
	    if ($data) {
	    	$id = $this->getRequest()->getParam('id');
	    	$model = '';

	    	if(isset($id) && !empty($id) && $id != 0) {
	    		$model = Mage::getModel('storelocator/locations')->load($id);
	    		$updatedAt = date('Y-m-d H:i:s');
	    		$data['updated_at'] = $updatedAt;
	    		$model->addData($data);
	    	} else {
	    		$model = Mage::getModel('storelocator/locations');
	    		$createdAt = date('Y-m-d H:i:s');
	    		$updatedAt = date('Y-m-d H:i:s');
	    		$data['created_at'] = $createdAt;
	    		$data['updated_at'] = $updatedAt;
	    		$model->setData($data);
	    	}

	    	try {
		    	$model->save();	    		
	    	} catch (Exception $e) {}

	    	Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('storelocator')->__('Location has been saved'));
	        $this->_redirect('*/*/');
	    } else {
	    	Mage::getSingleton('adminhtml/session')->addError(Mage::helper('storelocator')->__('Unable to save'));
	        $this->_redirect('*/*/');
	    }
	}

	public function deleteAction()
	{
	    $id = $this->getRequest()->getParam('id');
	    if ($id && $id != 0) {
	    	$model = Mage::getModel('storelocator/locations')->load($id);
	    	$model->delete();
	    	Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('storelocator')->__('Location has been deleted'));
	        $this->_redirect('*/*/');
	    } else {
	    	Mage::getSingleton('adminhtml/session')->addError(Mage::helper('storelocator')->__('Unable to Delete Location'));
	        $this->_redirect('*/*/');
	    }		
	}
}