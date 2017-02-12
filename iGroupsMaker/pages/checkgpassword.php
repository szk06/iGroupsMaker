<?php 

	$mysqlhost = "localhost";
	$user= "root";
	$dbname1 = "project";
	$sqlpass='';
	$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
	/////////////////////////////////////////////////
	$gpassword = $_POST['gpassword'];
	if(isset($gpassword)){
		$row = $handler->query("SELECT * FROM groups WHERE gpassword = '$gpassword' ");
		$myid="";
		foreach($row as $elm){
			$myid = $elm['gpassword'];
			
		}
		if($myid == NULL){
			
			print "yes";
		}
		else{
			print "no";
		}
		
		
	}else{
		
		exit("not set");
	}


?>