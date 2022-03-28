<?php Ccc::loadClass('Controller_Admin_Login'); ?>
<?php 
class Controller_Order extends Controller_Admin_Login
{
	public function __construct()
    {
        if(!$this->authentication())
        {
			$this->redirect($this->getLayout()->getUrl('login','admin_login'));
		}
    }

    public function editAction()
	{
		$orderId = (int) $this->getRequest()->getRequest('id');
		$this->setTitle('Order');
    	$orderModel = Ccc::getModel('Order')->load($orderId);
		$orderEdit = Ccc::getBlock('Order_Edit')->setOrder($orderModel);
		$content = $this->getLayout()->getContent();
		$content->addChild($orderEdit);
		$this->renderLayout();
	}
}