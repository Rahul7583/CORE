<?php Ccc::loadClass('Block_Core_Template');?>
<?php
class Block_Salesman_Edit extends Block_Core_Template
{
	protected $salesman = null;

	public function __construct()
	{
		$this->setTemplate('view/Salesman/edit.php');
	}

	public function setSalesman($salesman)
	{
		$this->salesman = $salesman;
		return $this;
	}

	public function getSalesman()
	{
		return $this->salesman;
	}

}