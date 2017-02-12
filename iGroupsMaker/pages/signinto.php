<?php 
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$idnumber = $_POST['idnumber'];
	$password = $_POST['password'];
	if(isset($fname)&&isset($lname)&&isset($email)&&isset($idnumber)&&isset($password)){
		
		if(empty($fname)||empty($lname)||empty($email)||empty($idnumber)||empty($password)){

			exit("empty");
			
		}else if(!preg_match("/^[a-zA-Z0-9]{2,}@{1}(.){2,}\.[a-z]{3}$/", $email)){
			exit("Error email");
		}else if(strlen($password)<6){
			exit("password error");
		}
		else{
			
						//Connect to the database
			$mysqlhost = "localhost";
			$user= "root";
			$dbname1 = "project";
			$sqlpass='';
			$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
			$hisid =NULL;
			
			$pdoQuery = "INSERT INTO `signed` (`id`, `Email`, `password`, `student_id`, `first_name`, `last_name`) 
			VALUES (:hisid, :email, :password, :idnumber, :fname, :lname)";
			$pdoResult = $handler->prepare($pdoQuery);
			$pdoExec = $pdoResult->execute(array(":hisid"=>$hisid,":email"=>$email,":password"=>$password,
			":idnumber"=>$idnumber, ":fname"=>$fname, ":lname"=>$lname));
			if($pdoExec)
			{
				header('Location: signupcomplete.html');
			}else{
				header('Location: signupfailed.html');
				//echo 'Error in posting<br>';
			}
		}
		
		
	}else{
		
		exit("not set");
	}
	
?>