<?php 
class Model_Core_Session 
{
	protected $namespace = null;

	public function __construct()
	{
		$this->setNamesapce('core');
		$this->startSession();
	}

	public function isStarted()
	{
		if(!$this->getId())
		{
			return false;
		}
		return true;
	}

	public function setNamesapce($namespace)
	{
		$this->namespace = $namespace;
		return $this;
	}

	public function getNamespace()
	{
		return $this->namespace;
	}

	public function startSession()
	{
		if(!$this->isStarted())
		{
			session_start();	
		}
		return $this;
	}

	public function getId($id = null)
	{
		if($id != null)
		{
			return session_id($id);	
		}
		return session_id();
	}

	public function regeneratedId()
	{
		if(!$this->isStarted())
		{
			$this->startSession();	
		}
		return session_regenerate_id();
		
	}

	public function unsetSession()
	{
		if($this->isStarted())
		{
		return session_destroy();
		}
			return $this;
	}

	public function __set($key, $value)
	{
		if(!$this->isStarted())
		{
			$this->startSession();
		}
		$_SESSION[$this->getNamespace()][$key] = $value;
		return $this;
	}

	public function __get($key)
	{
		if(!$this->isStarted())
		{
			return null;
		}
		
		if(!array_key_exists($key, $_SESSION[$this->getNamespace()]))
		{
			return null;
		}
		return $_SESSION[$this->getNamespace()][$key];
	}

	public function __unset($key)
	{
		if(!$this->isStarted())
		{
			return $this;
		}

		if(array_key_exists($key, $_SESSION[$this->getNamespace()]))
		{
			unset($_SESSION[$this->getNamespace()][$key]);
		}
		return $this;
	}
}
