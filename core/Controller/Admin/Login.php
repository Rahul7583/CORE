<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php
class Controller_Admin_Login extends Controller_Admin_Action
{
	public function loginAction()
	{
		$this->setTitle('Admin Grid');
		$adimnGrid = Ccc::getBlock('Admin_Login_Grid');
		$content = $this->getLayout()->getContent()->addChild($adimnGrid);
		$this->renderLayout();
	}

	public function loginPostAction()
	{
		try
		{
	  		$message = Ccc::getModel('Admin_Message');
			$adminModel = Ccc::getModel("Admin");
			$loginModel = Ccc::getModel("Admin_Login");
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("invalid request", 1);
			}
			$loginData = $request->getPost('login');
			$password = $loginData['password'];
			$admin = $adminModel->fetchAll("SELECT * FROM `admin` WHERE `email` = '{$loginData['email']}' AND `password` = '{$password}'");

			if(!$admin)
			{
				throw new Exception("invalid request", 1);
			}
			$loginModel->login($admin[0]->email);
			$message->addMessage('You are Logedin');
			$this->redirect($this->getLayout()->getUrl('grid','Product'));
		}
		catch (Exception $e) 
		{
			$this->redirect($this->getLayout()->getUrl('login','admin_login',[],true));
		}
	}

	public function logoutAction()
	{
		$loginModel = Ccc::getModel("Admin_Login");
		if($loginModel->getLogin())
		{
			$loginModel->logout();
		}
		$this->redirect($this->getLayout()->getUrl('login','Admin_Login'));		
	}

}