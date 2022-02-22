<?php  require_once 'Model/Core/Adapter.php'; ?>
<?php date_default_timezone_set("Asia/Kolkata");?>
<?php  require_once 'menu_header.php'; ?>
<?php $adapter = new Model_Core_Adapter(); ?>

<?php 
class Ccc{
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD

	public static $front = null;

	public static function setFront($front)
	{
		self::$front = $front;
	}

	public static function getFront()
	{		
		if(!self::$front)
		{
			Ccc::loadClass('Controller_Core_Front');
			$front = new Controller_Core_Front();
			self::setFront($front);
		}
		return self::$front;
	}
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
=======
>>>>>>> c9c862e1062c0764e4d939a70b90359653ebb7a6
	
	public static function loadFile($path)
	{
		require_once($path);
	}

	public static function loadClass($className)
	{
		$path=str_replace('_', '/', $className).".php"; //Controller/Customer.php
		self::loadFile($path);
	}

	public static function init()
	{
		self::getFront()->init();
	}	

	public static function getModel($className)
	{
		$className = "Model_".$className;
		self::loadClass($className);
		return new $className();
	}

	public static function getBlock($className)
	{
		$className = "Block_".$className;
		self::loadClass($className);
		return new $className();
	}
}


Ccc::init();

?>