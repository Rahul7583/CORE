<?php
class prodcut{

	public $name;
	public $price;
	public $quantity;

	 public function setName($name)
	{	
		$this->name=$name;
		return $this;
		
	}

	public function setPrice($price)
	{
		$this->price=$price;
		return $this;
	}

	public function setQuantity($quantity)
	{
			$this->quantity=$quantity;
			return $this;
	}

	public function getName()
	{
		return $this->name;
	}
	public function getPrice()
	{		
		return $this->price;
		
	}
	public function getQuantity()
	{
	  	return $this->quantity;
	}

	public function resetName()
	{
		$this->name=0;
		return $this;
	}

	public function resetPrice()
	{
		$this->price=0;
		return $this;
	}

	public function resetQuantity()
	{
		$this->quantity=0;
		return $this;
	}



}//end class

$p1=new prodcut();

$p1->setName('pen');
$p1->setPrice(15);
$p1->setQuantity(8);

 print_r($p1->getName());
 echo "<br>";
 print_r($p1->getPrice());
 echo "<br>";
 print_r($p1->getQuantity());
 echo "<br>";


 $p1->resetName();
 $p1->resetPrice();
 $p1->resetQuantity();

 echo "dispaly After called reset method "."<br>";

 print_r($p1->getName());
 echo "<br>";
 print_r($p1->getPrice());
 echo "<br>";
 print_r($p1->getQuantity());


?>