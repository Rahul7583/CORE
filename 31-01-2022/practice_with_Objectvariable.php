<?php

echo "<pre>";

class product{
	public $price=0;


}

$p1=new product();

print_r($p1);

$p1->price=10;

print_r($p1);


$p2=$p1;

//var_dump($p2);

print_r($p2);


$p2->price=50;

print_r($p2);

print_r($p1);



$p5=$p2;

$p5->price=100;

print_r($p2);
print_r($p1);
print_r($p5);




?>