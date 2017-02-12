<?php 
	$fname = $_SESSION['first_name'];
	$lname = $_SESSION['last_name'];
	$full = $fname." ".$lname;
	//print $full;
	$qid  = htmlentities($_GET['qid']);
	$mydata = htmlentities($_GET['mydata']);
	$myname = htmlentities($_GET['myname']);
	if (isset($qid) && isset($mydata) && isset($myname)){
		if(empty($qid) || empty($mydata) || empty($myname)){	
			exit("empty ya bro");
		}
		else{
			$mysqlhost = "localhost";
			$user= "root";
			$dbname1 = "project";
			$sqlpass='';
			$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
			$hisid =NULL;
				
			$pdoQuery = "INSERT INTO `answers` (`id`, `ques_id`, `name`, `adata`) 
			VALUES (:hisid, :qid, :myname, :mydata)";
			$pdoResult = $handler->prepare($pdoQuery);
			$pdoExec = $pdoResult->execute(array(":hisid"=>$hisid,":qid"=>$qid,":myname"=>$myname,
			":mydata"=>$mydata));
			if($pdoExec)
				{
					$sql = "SELECT * FROM questions WHERE id='$qid'";
					foreach($sql as $row){
						$rep = $row['replies'];
					
					}
					$rep++;
					$sql = "UPDATE `questions` SET `replies`=:rep WHERE id=:qid";
					$pdoResult = $handler->prepare($sql);
					$pdoExec=$pdoResult->execute(array(":rep"=>$rep,":qid"=>$qid));
					if($pdoExec){
						echo "replies number updated";
					}
					else{
						exit("replies not updated");
					}
					
					
					
					
					
					
					
					echo 'Mobile Number posted';
				}else{
					echo 'Error in posting mobile<br>';
				}
			
		}
		
	}
	else
	{
		
		exit("not set");
	}


?>