<?php Ccc::loadClass('Controller_Core_Action') ?>
<?php
class Controller_Customer_Price extends Controller_Core_Action
{
  public function gridAction()
  {
    $this->setTitle('Customer_Price_Grid');
    $customerPriceGrid = Ccc::getBlock('Customer_Price_Grid');
    $content = $this->getLayout()->getContent()->addChild($customerPriceGrid,'grid');
    $this->renderLayout();
  }

  public function saveAction()
  {
    try 
    {   
        $result = null;
        $product = $this->getRequest()->getPost('product');        
        $customerId = (int)$this->getRequest()->getRequest('id');
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
                throw new Exception("System can't save.", 1);
            }
            $this->getMessage()->addMessage('Data Saved.');
            $this->redirect($this->getLayout()->getUrl(null, null, ['id' => $customerId,'salesmanId' => $salesmanId], ));
        }
    catch (Exception $e) 
    {
        $this->getMessage()->addMessage($e->getMessage(), Model_Core_Message::ERROR);
        $this->redirect($this->getLayout()->getUrl(null,null,['id'=> $id]));
    }
  }
}
