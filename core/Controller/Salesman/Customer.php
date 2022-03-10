<?php 
Ccc::loadClass('Controller_Core_Action');
Ccc::loadClass('Model_Core_Request');

class Controller_Salesman_Customer extends Controller_Core_Action{

	public function gridAction()
	{

		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock("Salesman_Customer_Grid");
		$content->addChild($salesmanGrid,'grid');
		
		$this->renderLayout();
	}

	public function saveAction()
    {
    	$adminMessage = Ccc::getModel('Admin_Message');
        $customerModel = Ccc::getModel('Customer');
        $customerBlock = Ccc::getBlock('Salesman_Customer_Grid');
        $request = $this->getRequest();
        $salesmanId = $request->getRequest('id');
        $customerData = $request->getPost('customer');
        if($salesmanId)
        {
            $customerModel->salesmanId = $salesmanId;
            foreach($customerData as $customer)
            {
                $customerModel->customerId = $customer;
                $result = $customerModel->save(); 

                if(!$result)
                {
                    $adminMessage->addMessage("Salesman NOT added");
                    throw new Exception("Error Processing Request", 1);
                }
                $adminMessage->addMessage("Salesman added");
            }
			$this->redirect($this->getLayout()->getUrl('grid','Salesman_Customer',['id' => $customerBlock->getSalesmanId()]));
        }
    }
}