<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 
class Controller_Admin_Login extends Controller_Core_Action{

	public function loginAction()
	{
		$content = $this->getLayout()->getContent();
		$adminGrid = Ccc::getBlock('Admin_Login');
		$content->addChild($adminGrid);
		// $customer = $this->getLayout()->getChild('content')->getChild('Block_Admin_Login');
		$this->renderLayout();
	}

	public function loginPostAction()
	{
		try {
			$request = $this->getRequest();
			$adminLogin = $request->getPost('login');
			$adminModel = Ccc::getModel('Admin');
			$adminloginMessage = Ccc::getModel('Admin_Message');

			if (!$adminLogin) 
			{
				throw new Exception("Invalid Request.", 1);
			}
			if ($adminLogin['email'] == NULL) 
			{	
				throw new Exception("Enter Email.", 1);
			}
			if ($adminLogin['password'] == NULL) 
			{	
				throw new Exception("Enter Password.", 1);
			}
			$email = $adminLogin['email'];
			$password = $adminLogin['password'];

			$admin = $adminModel->login($email, $password);
			$adminloginMessage->login = $admin;
			if ($adminloginMessage->login == 1) {
				$this->redirect($this->getLayout()->getUrl('grid','Product'));
			}
			$this->redirect($this->getLayout()->getUrl('login','Admin_Login'));
		} catch (Exception $e) {
			echo $e;
		}

	}
		
	public function logoutAction()
	{
		$logout = Ccc::getModel('Admin');
		$logout = $logout->logout();
		$this->redirect($this->getLayout()->getUrl('login','admin_login'));
	}
}


