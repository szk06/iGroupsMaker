<?php 
	session_start();
	$coursename=$_POST['coursename'];
	$numofstud=$_POST['numofstud'];
	$gname=$_POST['gname'];
	$gpassword=$_POST['gpassword'];
	$groupmakerid = $_SESSION['student_id'];
	$studentid = $_SESSION['student_id'];


	
	if(isset($coursename)&&isset($numofstud)&&isset($gname)&&isset($gpassword)) {
		
		if(empty($coursename)||empty($numofstud)||empty($gname)||empty($gpassword)){

			exit("empty");
			
		}
		else{
			
			//Connect to the database
			$mysqlhost = "localhost";
			$user= "root";
			$dbname1 = "project";
			$sqlpass='';
			$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
			
			// insert the new group in the groups table
			$pdoQuery = "INSERT INTO `groups` (`gname`, `gpassword`, `numofstud`, `coursename`, `groupmakerid`) VALUES (:gname, :gpassword, :numofstud, :coursename, :groupmakerid)";
			$pdoResult = $handler->prepare($pdoQuery);
			$pdoExec = $pdoResult->execute(array(":gname"=>$gname,":gpassword"=>$gpassword,":numofstud"=>$numofstud,":coursename"=>$coursename,":groupmakerid"=>$groupmakerid));

			// now need to retreive the groupid
			$row = $handler->query("SELECT id FROM groups WHERE groupmakerid = '$groupmakerid' ");
			$groupid="";
			foreach($row as $elm){
				$groupid = $elm['id'];
			
			}


			// add the student that created the group to the members table
			$pdoQuery2 = "INSERT INTO `members` (`groupid`, `studentid`, `gpassword`, `gname2`) VALUES (:groupid, :studentid, :gpassword, :gname2)";
			$pdoResult2 = $handler->prepare($pdoQuery2);
			$pdoExec2 = $pdoResult2->execute(array(":groupid"=>$groupid,":studentid"=>$studentid,":gpassword"=>$gpassword,":gname2"=>$gname));

			
			if($pdoExec && $pdoExec2)
			{
				header('Location: mygroups.php');
			}else{
				header('Location: creategroup.php');
				//echo 'Error in posting<br>';
			}
		}
		
		
	}else{
		
		exit("not set");
	}
	
?>