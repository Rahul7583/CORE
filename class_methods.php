<?php
//1. class_alias()  create the class same as class
echo "1 class_alias()"."<br>";
class fruit{


}

class_alias('fruit','cars');

$apple=new fruit();

$banana=new cars();

echo is_a($banana,'w');

if ($banana) {
	# code...
	echo "accept"."<br>";
}
else{
	echo "not accept"."<br>";
}


//2. class_exist() check class is define or not
//case in sensitive a=A; SAME

//echo class_exists(fruit);
echo "2 class_exists(class_name)"."<br>";


echo class_exists(A);

if(class_exists(FRUIT) ){
	echo "yes"."<br>";
}
else{
	echo "Not define"."<br>";
}




//3. get_class() return name of the class 
//inside method accept object name
echo "3 get_class()"."<br>";

echo get_class($apple);
echo get_class();


//4.get_called_class() return name of the class if in class has static method
// try without static 

echo "4 get_called_class()";

class Mobile{
	 static public  function display(){

		echo get_called_class()."<br>";
	}



}

echo get_called_class(); //error  

$a=new Mobile();
$a->display();


//5.get_class_methods()
// return the method names in array type because 
//one class can have more than one method



echo "5 get_class_methods(class_name)"."<br>";
class calculation{

	function add(){

	}

	function sub(){

	}

	function mul(){

	}
} 

print_r(get_class_methods(calculation));

//echo get_class_methods(calculation);

$class_method=get_class_methods(calculation);

foreach ($class_method as $value) {
	# code...
	echo $value."<br>";
}


//6..get_class_vars()
//return Returns an associative array   

echo "method 6 get_class_vars()"."<br>";
class variable_info{

	var $name='Rahul';
	var $age;
}

$variable_info=new variable_info();

$info=get_class_vars(get_class($variable_info));

foreach ($info as $key => $value) {
	# code...
	echo $key.":".$value."<br>";
}

//print_r(get_class_vars($variable_info));



//7.get_declared_classes()
//retrun the availabe class in current script
echo "method 7 get_declared_classes()"."<br>";

class A{

} 
class B{

}
class C{

}

//print_r(get_declared_classes()); //OUTPUT all the avaialbe classes


//8. get_declared_interfaces
//return array of available all the interfaces in current script.

echo "method 8 get_declared_interfaces()"."<br>";

interface Template{

}

//print_r(get_declared_interfaces());


//9.get_parent_class()
//return paraent class name if exists.

echo "9 get_parent_class()"."<br>";
class alphabet{

}
class z extends alphabet{

}

$obj=new z();
$alp=new alphabet();
echo get_parent_class($obj)."<br>";
//echo get_parent_class($alp);//no output because parent class not exists.
//echo get_parent_class(z);//output with warning


//10.interface_exists()
//accept interface name as a string parameter, return true 1 if exists

echo "10 interface_exists(interface_name)"."<br>";


echo interface_exists('Template')."<br>"; // return true
echo interface_exists('alphabet')."<br>"; // no output


//11.is_a()
//accept 2 parameter one is object and class name 
// if given object related with given class then return true.
echo "11 is_a(object,'class_name') method"."<br>";

class bike{

}

$b1=new bike();
echo is_a($b1,'bike')."<br>";//return 1
echo is_a($b1,'kdf'); //no output



//12. is_sub_class()
// accept two parameter and return true 1 if sub class is exists
//same working with interface.

echo "12 is_subclass_of(object,'classname')"."<br>";
class redmi{

}
class asus extends redmi{

}

$m=new redmi();
$as=new asus();

echo is_subclass_of($m, 'redmi');//no subclass found

echo is_subclass_of($as, 'redmi')."<br>";


//13.method_exists() return true 1 if given method exists in class
echo "13 method_exists(object, method_name)"."<br>";

class IT{
		function display(){

		}
		function print(){

		}
} 

$it=new IT();

echo method_exists($it, 'print')."<br>"; // 1 
echo method_exists($it, 'fjng');


//14.property_exists()
// accept class name property name  as argument 
echo "14 property_exists(class, property)"."<br>";

class computer{
	public $dell;
	public $hp;
}
//$com=new computer();

echo property_exists('computer','dell')."<br>"; //true 1
echo property_exists('IT', 'hp'); //false



//15. trait_exists()
//return true 1 if trait exists in your script

echo "15 trait_exists('trait_name')"."<br>";

trait test1{
	function hello(){
		echo "hello"."<br>";
	}
}

class person{
		use test1;
}
class mango{
		use test1;
}

$ob=new person();
$obq=new mango();

$ob->hello();

echo trait_exists('test1')."<br>";


//16.. get_declared_traits()
//return array type if trait availabe in your script, no parameter required 
//

echo "16 get_declared_traits()"."<br>";

print_r(get_declared_traits());
 
 echo "<br>";
 //echo get_declared_traits()."<br>"; // error 


//17 class_uses() return array type
 //return the traits used by the given class.
echo "17 class_uses('class name') "."<br>";


print_r(class_uses('person'));//output based on above example
print_r(class_uses('mango')); //output based on above example
//print_r(class_uses('jdsnf'));//error 
echo "<br>";


//18. class_implements()
/*
return array type and parameter will be class name or object name.
*/

echo "18 class_implements('class_name' or object_name)"."<br>";


interface foo{

}

class boo implements foo {

}

$b=new boo();

print_r(class_implements($b)); //boo class implements foo interface
echo "<br>";
print_r(class_implements('boo'));


//19


?>


