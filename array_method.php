<?php
//1 is_array()  return true or false
echo "1 is_array(array_type_variable)"."<br>";

$student_info= array('name' => 'rahul',
						'enroll'=>190163107029,
						'sem'=>8
	 );

//$student=123;

if(is_array($student_info)){
	echo "yes"."<br>";
}
else{
	echo "no"."<br>";
}




//2 array_change_key_upper();
//change the case of key either upper or lower(by defalut)
//rturn array

echo "2 array_change_key_case(array_type_variable,CASE_UPPER)"."<br>";

print_r(array_change_key_case($student_info,CASE_UPPER));
echo "<br>";

//3 array_chunk()
//divid your array into given chunk a b c d =>ab cd

echo "3 array_chunk(input, size)"."<br>";
echo "<pre>";
//$name=array("R","A","h","u","l"); //as a consider diffrent chunk
$name=array("rahul prajapati");// as a consider 1 chunk
print_r(array_chunk($name, 2));
echo "<br>";



//4 array_slice(array_variable,start,end)
// offset is negative then start with end of the array
// offset is non-negative then start with 0th index
//if in function true are there then original key will be display

echo "4 array_slice(array, offset)"."<br>";


$input=array("r","a","h","u","l","p");
print_r(array_slice($input,1,3,true)); //ahu
echo "<br>";
print_r(array_slice($input,-2,3));//lp but how 
echo "<br>";

$in = array('0' =>9,
			'1'=>5,
			'2'=>5,
			'3'=>8,
			'4'=>2,
			'5'=>9
			 );

print_r(array_slice($in,2,3));
echo "<br>";



//5. array_merge($array1,$array2)
//
echo " 5 array_merge(array1,array2)"."<br>";

$arr1=array('color' => 'red','rahul',1=>2);
$ar2=array('prajapati',9,7,'color'=>'white',1=>5);

print_r(array_merge($arr1,$ar2));
echo "<br>";


//6.array_replace($array1,$array2)
echo "6 array_replace(array, array1)"."<br>";

$a1=array('orange','cheery','banana');
$a2=array(1=>'mobile','redmi','cheery');

print_r(array_replace($a1,$a2));
echo "<br>";


//7.array_reverse();
echo "7 array_reverse()"."<br>";
print_r(array_reverse($a1));
echo "<br>";


//8.array_intersect($a1,$a2)
echo "8 array_replace(array, array1)"."<br>";
print_r(array_intersect($a1, $a2));



//9.array_key_exists();
echo "9 array_key_exists(key, array)"."<br>";

$search=array(1=>'rahul',2=>'prajapati',3=>'orange',4=>'apple','mobile'=>'asus');
print_r(array_key_exists('mobile',$search));
echo "<br>";


//10 array_pop(); remove the last element of the array
echo "10 array_pop(array_type_variable)"."<br>";
print_r(array_pop($search));
echo "<br>";


//11 array_push()
echo "11 array_push(array_type_variable)"."<br>";
array_push($search, 'red','green','blue');
print_r($search);
echo "<br>"; 



//12 asort();sorting element on ascending order 
//sorting based on key
echo "12 asort(array_type_variable)"."<br>";


$no=array(25,12,36,10);
asort($no);

foreach ($no as $key => $value) {
	# code...
	echo $value."<br>";

}


//13 arsort() sorting the array in descending order 
//sorting based on key
echo "13 arsort(array_type_variable)"."<br>";


$no2=array('b'=>'ball','d'=>'demo','a'=>'apple');
arsort($no2);

foreach ($no2 as $key => $value) {
	# code...
	echo $key.":".$value."<br>";
}

//14..array_rand()
echo "14 array_rand(array_type_variable)"."<br>";

$random_info=array_rand($no2);	

echo $random_info."<br>";



//15 array_combine() two array as a key value pair  

echo "15 array_combine(keys, values)"."<br>";

$company_name=array('Asus','MI','Motorola','Dell');
$Model_number=array('zenphone_max_pro','Y1','G5','vostro 3000');

print_r(array_combine($company_name, $Model_number));

echo "<br>";




//16.. array_unique(array_type_variable);
echo "16 array_unique(array_type_variable)"."<br>";
$duplicate_array=array('no1'=>12,
						'no2'=>15,
						'no3'=>18,
						'no4'=>15,
						'no2'=>18	);

print_r(array_unique($duplicate_array));
echo "<br>";




//17 array_intersect_key();
//in both array check key only if intersect then rerutn that key and value;
echo "17 array_intersect_key(array1, array2)";

$de1=array('1'=>12,
			'2'=>15,
			'4'=>18);
$de2=array('2'=>21,
			'5'=>26);

print_r(array_intersect_key($de1,$de2));
echo "<br>";



//18 add_pad() 
echo " 18 array_pad(input, pad_size, pad_value)";

$dummy=array(12,15,814);

$d1=array('1'=>'rahul');

print_r(array_pad($d1,6,0));



//19 array_sum(); return sum of the values 
//return direct value
echo "19 array_sum(array_type_variable)";

echo array_sum($dummy)."<br>"; // 841 use above array



//20.. array_flipped();
//array return key fliped with value and value with key

echo "20 array_flip(array_type_variable)";

print_r(array_flip($dummy));
echo "<br>";
print_r(array_flip($d1));












?>