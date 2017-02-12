<?php 
	session_start();

	$projectname=$_POST['projectname'];
	$projectdescription=$_POST['projectdescription'];
	$coursename=$_POST['coursename'];
	$numofstud=$_POST['numofstud'];
	$gname=$_POST['gname'];
	$gpassword=$_POST['gpassword'];
	$groupmakerid = $_SESSION['student_id'];
	$studentid = $_SESSION['student_id'];


	
	if(isset($projectname)&&isset($projectdescription)) {
		
		if(empty($projectname)||empty($projectdescription)) {

			exit("empty");
			
		}
		else{
			
			//Connect to the database
			$mysqlhost = "localhost";
			$user= "root";
			$dbname1 = "project";
			$sqlpass='';
			$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
			// insert into table project, the project title and description

			$pdoQuery = "REPLACE INTO `projects` (`groupname`, `coursename`, `projectname`, `projectdescription`) VALUES (:groupname, :coursename, :projectname, :projectdescription)";
			$pdoResult = $handler->prepare($pdoQuery);
			$pdoExec = $pdoResult->execute(array(":groupname"=>$gname,":coursename"=>$coursename,":projectname"=>$projectname,":projectdescription"=>$projectdescription));

			
			if($pdoExec)
			{
				header('Location: myprojects.php');
			}else{
				header('Location: myprojects.php');
				//echo 'Error in posting<br>';
			}
		}
		
		
	}else{
		
		exit("not set");
	}
	
?>