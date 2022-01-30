
<?php

echo $name='rahul'; //String type variable
echo "<br>"; 

echo $age=20;
echo "<br>";         //int type variable

$salary=50000.21;//float type Variable
echo $salary;
echo "<br>";

var_dump($salary);  //type check of variable
echo "<br>";

echo $flag=true;
echo "<br>";


//Array type variable declartion
$student_info=array(
	'Name'=>'rahul',
	'Enroll'=>190163107029,
	'Sem'=>8
);

print_r($student_info);
echo "<br>";
var_dump($student_info);



?>