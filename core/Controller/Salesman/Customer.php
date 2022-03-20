<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Salesman_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
        $this->setTitle('Salesman_Customer_Grid');
        $salesmanGrid = Ccc::getBlock("Salesman_Customer_Grid");
		$content = $this->getLayout()->getContent()->addChild($salesmanGrid,'grid');
		$this->renderLayout();
	}

	public function saveAction()
    {
        try 
        {
            $customerModel = Ccc::getModel('Customer');
            $customerBlock = Ccc::getBlock('Salesman_Customer_Grid');
            $request = $this->getRequest();
            $salesmanId = (int)$request->getRequest('id');
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
                        throw new Exception("Something wrong with your data.", 1);
                    }
                    $this->getMessage()->addMessage("Data Saved.");
                }
                $this->redirect($this->getLayout()->getUrl('grid','Salesman_Customer',['id' => $customerBlock->getSalesmanId()]));
            }
            
        } 
        catch (Exception $e) {
            $this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
            $this->redirect($this->getLayout()->getUrl('grid'));
        }
    }
}