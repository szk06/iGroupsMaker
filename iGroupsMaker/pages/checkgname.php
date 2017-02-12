<?php 

	$mysqlhost = "localhost";
	$user= "root";
	$dbname1 = "project";
	$sqlpass='';
	$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
	/////////////////////////////////////////////////
	$gname = $_POST['gname'];
	if(isset($gname)){
		$row = $handler->query("SELECT * FROM groups WHERE gname = '$gname' ");
		$myid="";
		foreach($row as $elm){
			$myid = $elm['gname'];
			
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