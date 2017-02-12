<?php 

	$mysqlhost = "localhost";
	$user= "root";
	$dbname1 = "project";
	$sqlpass='';
	$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
	/////////////////////////////////////////////////
	$idnumber = $_POST['idnumber'];
	if(isset($idnumber)){
		$row = $handler->query("SELECT * FROM signed WHERE student_id = '$idnumber' ");
		foreach($row as $elm){
			$myid = $elm['student_id'];
			
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