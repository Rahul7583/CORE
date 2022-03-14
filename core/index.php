<?php  require_once 'Model/Core/Adapter.php'; ?>
<?php date_default_timezone_set("Asia/Kolkata");?>
<?php $adapter = new Model_Core_Adapter(); ?>
<?php 
class Ccc
{
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

	public function register($key, $value)
	{
		$GLOBALS[$key] = $value;
	}

	public function getRegistry($key)
	{
		if(!array_key_exists($key, $GLOBALS))
		{
			return null;
		}
		return $GLOBALS[$key];
	}

	public static function unregistry($key)
    {
        if (!array_key_exists($key, $GLOBALS))
        {
        	return null;
        }
        unset($GLOBALS[$key]);
    }

    public static function getConfig()
    {
        if (!($config = self::getRegistry('config'))) 
        {
            $config = self::loadFile('etc/config.php');
            self::register('config',$config);
        }
        return $config;
    }
	
	public static function loadFile($path)
	{
		return require_once($path);
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