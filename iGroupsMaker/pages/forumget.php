<?php 
	$qid = $_GET['qid'];
	if(isset($qid)){
		
	/////////////////////////////////////Connect to Database///////////////////
		header("Content-type: application/json");
		$mysqlhost = "localhost";
		$user= "root";
		$dbname1 = "project";
		$sqlpass='';
		$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
		
		$sql1 = $handler ->query("SELECT * FROM questions WHERE id='$qid'");
		foreach($sql1 as $rows){
			
			$qdata = $rows['qdata'];
			$name = $rows ['asker'];
			$rep = $rows['replies'];
			
		}
		print"{\n	\"name\":	\"$name\", \n \"qdata\":	\"$qdata\" ,\n \"answers\":	[\n ";
		
		$sql2 = $handler ->query("SELECT * FROM answers WHERE ques_id = '$qid'");
		
		$sql3 = $handler ->query("SELECT * FROM answers WHERE ques_id = '$qid'");
		$count =0;
		foreach($sql3 as $hani){
			$count++;
		}
		$counter =1;
		foreach($sql2 as $rows2){
			$hisname = $rows2['name'];
			$adata = $rows2['adata'];
			print "\n{\"hisname\": \"$hisname\", \"adata\":	\"$adata\"}";
			if($counter<$count){
				print ",\n";
				
			}
			$counter++;
		}
		print "  ]\n}\n";
	
	/////////////////////////////////////////////////////////////////////////////
		
	}
	else{
		exit("error set");
	}





?>