<?php 
	session_start();
	$gpassword=$_POST['gpassword'];
	$studentid = $_SESSION['student_id'];

	
	if(isset($gpassword)) {
		
		if(empty($gpassword)){

			exit("empty");
			
		}
		else{
			
			//Connect to the database
			$mysqlhost = "localhost";
			$user= "root";
			$dbname1 = "project";
			$sqlpass='';
			$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);

			// steps, first check if the password exists, if it does, insert in the table where gpassword=gpassword
			$row = $handler->query("SELECT groupid,gname2 FROM members WHERE gpassword = '$gpassword' ");
			$groupid="";
			$gname2="";
			foreach($row as $elm){
				$groupid = $elm['groupid'];
				$gname2 = $elm['gname2'];
			}
			if($groupid == NULL){
				//print "yes";
			}
			else{
				//print "no";
			}
			
			$pdoQuery = "INSERT INTO `members` (`groupid`, `studentid`, `gpassword`, `gname2`) VALUES (:groupid, :studentid, :gpassword, :gname2)";
			$pdoResult = $handler->prepare($pdoQuery);
			$pdoExec = $pdoResult->execute(array(":groupid"=>$groupid,":studentid"=>$studentid,":gpassword"=>$gpassword,":gname2"=>$gname2));
			if($pdoExec)
			{
				header('Location: mygroups.php');
			}else{
				//header('Location: joingroup.php');
				echo 'Error in posting<br>';
			}
		}
		
		
	}else{
		
		exit("not set");
	}
	
?>