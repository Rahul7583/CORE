<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php

class Controller_Customer_Price extends Controller_Core_Action{

  public function gridAction()
  {
    $content = $this->getLayout()->getContent();
    $customerPriceGrid = Ccc::getBlock('Customer_Price_Grid');
    $content->addChild($customerPriceGrid,'grid');
    $this->renderLayout();
  }

  public function saveAction()
  {
    try 
    {   
        $result = null;
        $product = $this->getRequest()->getPost('product');        
        $customerId = $this->getRequest()->getRequest('id');
        $salesmanId = $this->getRequest()->getRequest('salesmanId');

        foreach ($product as $key => $value) { 
            $customerPrice = Ccc::getModel('Customer_Price');   
            if($key == 'new'){
                foreach ($value as $productId => $price) {
                    if ($price){
                        $customerPrice->customerId = $customerId;
                        $customerPrice->productId = $productId;
                        $customerPrice->price = $price;
                        $result = $customerPrice->save();
                    } 
                }   
            }
            else
            {
                foreach ($value as $entityId => $price) 
                {
                    $customerPrice->price = $price;
                    $customerPrice->entityId = $entityId;
                    $result = $customerPrice->save(); 
                }   
            }   
        }
            if (!$result) 
            {
                $this->getMessage()->addMessage("System can't save.", Model_Core_Message::ERROR);   
                throw new Exception("System can't save.", 1);
            }
            $this->getMessage()->addMessage('Data Saved.');
            $this->redirect($this->getLayout()->getUrl(null, null, ['id' => $customerId,'salesmanId' => $salesmanId], ));
        }
    catch (Exception $e) 
    {
      
    }
  }
}
