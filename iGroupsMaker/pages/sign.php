<?php 


	$mysqlhost = "localhost";
	$user= "root";
	$dbname1 = "project";
	$sqlpass='';
	$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
	/////////////////////////////////////////////////
	$email =  $_POST['email'];
	if(isset($email)){
		$row = $handler->query("SELECT * FROM signed WHERE Email='$email' ");
		foreach($row as $elm){
			$myemail = $elm['Email'];
		}
		if($myemail==NULL){
			print "yes";
		}
		else{
			print "no";
		}
		
	}
	else{exit("not set");}

?>