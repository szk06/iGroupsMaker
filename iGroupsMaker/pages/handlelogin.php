<?php 

	/////////////////////////////////////Connect to Database///////////////////
	
	$mysqlhost = "localhost";
	$user= "root";
	$dbname1 = "project";
	$sqlpass='';
	$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
	
	/////////////////////////////////////////////////////////////////////////////
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	if(isset($email) && isset($password)){
		
		if(empty($email) || empty($password) ){
			exit("Error in submission");
		}
		else{
			$row = $handler->query("SELECT * FROM signed WHERE Email='$email'");
			$myemail="";
			foreach($row as $elm){
				$myemail = $elm['Email'];
				$mypassword = $elm['password'];
			}
			if($myemail==NULL){
				$enter = false;
			}
			else if($password!=$mypassword){
				
				$enter = false;
				
			}
			else{
				$enter = true;	
			}
			
			
			if($enter==false){
				include("logerror.html");
				
			}
			else if($enter == true){
				session_start();
				$first_name="";
				$last_name="";
				$idnumber="";
				//$email2="";
				$user = $handler->query("SELECT first_name,last_name,student_id FROM signed WHERE Email='$email'");
				foreach($user as $us){
					$first_name=$us['first_name'];
					$last_name=$us['last_name'];
					$idnumber=$us['student_id'];
				}
				$_SESSION['first_name']=$first_name;
				$_SESSION['last_name']=$last_name;
				$_SESSION['email']=$email;
				$_SESSION['student_id']=$idnumber;

				if($first_name=="Admin" && $last_name=="Admin" ||$first_name=="Haidar" && $last_name=="Safa"){
					header('Location: admindashboard.php');
				}
				else{
					header('Location: dashboard.php');
				}

				
				

			}
			
			
			
			
			
			
		}
	}
	else{
		
		exit("Error in Submission");
	}


?>