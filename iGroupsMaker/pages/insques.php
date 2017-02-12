<?php 
	$data =htmlentities($_GET['data']);
	$myname =htmlentities($_GET['myname']);
	$title =htmlentities($_GET['title']);
	if(isset($data) && isset($myname) && isset($title)){
		if(empty($data) || empty($myname) || empty($title)){
			exit("something empty");
			
		}else{
			$mysqlhost = "localhost";
			$user= "root";
			$dbname1 = "project";
			$sqlpass='';
			$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
			$hisid =NULL;
			$num =0;
			$pdoQuery = "INSERT INTO `questions` (`id`, `title`, `asker`, `replies`, `qdata`) 
			VALUES (:hisid, :title, :myname, :num, :data)";
			$pdoResult = $handler->prepare($pdoQuery);
			$pdoExec = $pdoResult->execute(array(":hisid"=>$hisid,":title"=>$title,":myname"=>$myname,
			":num"=>$num, ":data"=>$data));
			if($pdoExec)
				{
					echo 'Question inserted';
				}else{
					echo 'Error in posting';
				}
			
		}
		
	}else{
		exit("not set");
	}




?>