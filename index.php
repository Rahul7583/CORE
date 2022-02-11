<?php  require_once 'Model/Core/Adapter.php'; ?>

<?php 

class Ccc{
	public static function loadFile($path)
	{
		require_once($path);

	}

	public static function loadClass($className)
	{
		$path=str_replace('_', '/', $className).".php"; //Controller/Customer.php
		Ccc::loadFile($path);
	}

	public static function init()
	{
			$actionName=(isset($_GET['a'])) ? $_GET['a'] : 'error'; 
			$actionName=$actionName."Action"; //gridAction

			$controllerName=(isset($_GET['c'])) ? ucfirst($_GET['c']) : 'Customer'; //Customer
			$controllerPath='Controller/'.$controllerName.'.php'; //Controller/Customer.php
			$controllerClassName='Controller_'.$controllerName; // Controller_Customer

			Ccc::loadClass($controllerClassName);
			$controller = new $controllerClassName();
			$controller->$actionName();
	}	
}

Ccc::init();

?>