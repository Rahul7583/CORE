<?php
echo "<pre>";

class Adapater{
	private $host_name="localhost";
	private $username="root";
	private $password="Root";
	private $db_name="test";

	


	public function connection(){

		 $con=mysqli_connect($this->host_name,$this->username,$this->password,$this->db_name);
			return $con;
		/*
		if($con){
			echo "yes"."<br>";
		}
		else{
			echo "no";
		}
		*/				
	}
	
	public function insert(){
		
		$con=$this->connection();
		
		$query="insert into product values('2','mixer','1500','2','2014-01-10 08:11:14')";

		
		$result=mysqli_query($con,$query);
		
		if($result){
		    return true;
		    //echo "yes";
		}
		else{
			return false;
			//echo "false";
		}
	}
	public function update(){
		$con=$this->connection();

		$query="update product SET quantity='23' WHERE(id='1')";
		$result=mysqli_query($con,$query);

		if($result){
			
			return true;
			//echo "updated";
				
		}
		else{
			
			return false;
			//echo "not updated..";
			
		}		

	}
	public function delete(){

		$con=$this->connection();

		$query="delete from product where id='2'";
		$result=mysqli_query($con,$query);

		if($result){
				
				return true;
				//echo "deleted";
		}
		else{
			return false;
			//echo "not delted";
		}

	}
	public function fetch(){
		$con=$this->connection();

		$fetched_data=array();
		$query="select * from product";

		$result=mysqli_query($con,$query);

		while ($row = mysqli_fetch_assoc($result)) {
			$fetched_data[]=$row;
		}

		return $fetched_data;
		//print_r($fetched_data);

	}
	
}

$a1=new Adapater();

//$a1->connection();
//$a1->insert();
//$a1->update();
//$a1->delete();
//$a1->fetch();

?>