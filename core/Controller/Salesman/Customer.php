<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Salesman_Customer extends Controller_Core_Action
{
	public function gridAction()
	{

		$content = $this->getLayout()->getContent();
		$salesmanGrid = Ccc::getBlock("Salesman_Customer_Grid");
		$content->addChild($salesmanGrid,'grid');
		
		$this->renderLayout();
	}

	public function saveAction()
    {
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
                    $this->getMessage()->addMessage("Something wrong with your data.", Model_Core_Message::ERROR);
                    throw new Exception("Error Processing Request", 1);
                }
                $this->getMessage()->addMessage("Data Saved.");
            }
			$this->redirect($this->getLayout()->getUrl('grid','Salesman_Customer',['id' => $customerBlock->getSalesmanId()]));
        }
    }
}