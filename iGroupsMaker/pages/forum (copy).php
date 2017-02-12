<!DOCTYPE html>
<?php 
session_start();
$fname = $_SESSION['first_name'];
$lname = $_SESSION['last_name'];
$full = $fname." ".$lname;



	
					$mysqlhost = "localhost";
					$user= "root";
					$dbname1 = "project";
					$sqlpass='';
					$handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
?>

<html lang="en">

<head>
	<script type="text/javascript">
		
		window.onload= pageLoad;
		function pageLoad(){
			var btn1 = document.getElementById("subques");
			btn1.onclick = ask;
			
			
		}
		function ask(){ 
			var start = true;
			var ques = document.getElementById("quesid");
			
			var questitle = document.getElementById("questitle");
			if(ques.value==""){
				
				ques.style.border=" solid red 1px";
				start =false;
				
			}
			if(questitle.value==""){
				questitle.style.border=" solid red 1px";
				start =false;
			}
			if(start ==true){
				var title =  questitle.value;
				
				var data = ques.value;
				//alert(title+" "+data+" "+ " "+"<?=$full?>");
				var ajax = new  XMLHttpRequest();
				ajax.onreadystatechange = function() {
					if (ajax.readyState == 4 && ajax.status == 200) {
						var mytext = ajax.responseText;
						//alert(mytext);
						if(mytext=="Question inserted"){
							var adiv = document.getElementById("questionask");
							adiv.innerHTML="";
							adiv.innerHTML="You Question is posted";
						}
					}
				};
				ajax.open("GET", "insques.php?title="+title+"&data="+data+"&myname="+"<?=$full?>", true);
				ajax.send();
				
			}
		}
		
		function setans(){
			
			alert("clicked");
			
		}
		function trigger(x){
			/*
			if(x==1){	
				alert("clicked");
			}
			else{
				alert("not good");
			}*/
			var ajax = new  XMLHttpRequest();
			ajax.onreadystatechange = function() {
				if (ajax.readyState == 4 && ajax.status == 200) {
					//document.getElementById("demo").innerHTML = xhttp.responseText;
					var mytext = ajax.responseText;
					var data = JSON.parse(mytext);
					mydiv = document.getElementById("dumpdiv");
					mydiv.innerHTML = "";
					var diving = document.createElement("div");
					diving.innerHTML = "Question #"+x+"<br>";
					mydiv.appendChild(diving);
					
					var div1 = document.createElement("div");
					var span1 = document.createElement("span");
					//alert(data.name);
					span1.innerHTML = "<br>Asked By:"+data.name+"<br><br>Question:"+data.qdata;
					div1.appendChild(span1);
					mydiv.appendChild(div1);
					divy = document.createElement("div");
					divy.innerHTML = "<br><font color=\"red\"<br>Number of Answers:"+data.answers.length+"</font>";
					mydiv.appendChild(divy);
					var difs = document.createElement("div");
					
					var i =0;
					for(i=0;i<data.answers.length;i++){
						var j = i+1;
						var ans =document.createElement("div");
						ans.innerHTML = "Answer #"+j+"<br><br>"+"Answered By:<font color=\"red\">"+data.answers[i].hisname+"</font><br><br>"
						+"Answer:"+data.answers[i].adata;
						difs.appendChild(ans)+"<br><br>";
					}
					mydiv.appendChild(difs);

					//alert(mytext);
					var yours = document.createElement("div");
					
					var btn  =  document.createElement("Button");
					var t = document.createTextNode("Submit Answer");
					btn.appendChild(t);
					var yousami = document.createElement("h3");
					yousami.innerHTML = "You can enter your answer in the text area";
					
					var your_ans = document.createElement("TEXTAREA");
					//btn.id = "clickans";
					your_ans.placeholder = "Enter your answer here please";
					your_ans.id = "answertext";
					your_ans.cols ="50";
					your_ans.rows ="4";
					yours.appendChild(yousami);
					yours.appendChild(your_ans);
					var myhim=document.createElement("div");
					myhim.appendChild(btn);
					yours.appendChild(myhim);
					yours.id = "toadd";
					
					mydiv.appendChild(yours);
					btn.onclick = function(){
						//alert("click");
						if(your_ans.value==null || your_ans.value=="" ){
							your_ans.placeholder="you can't leave it empty and submit";
							your_ans.style.border="solid red 1px";
						}
						else{
							//alert("here");
							var mydata = your_ans.value;
							var div2 = document.getElementById("toadd");
							div2.innerHTML="";
							
							yours.innerHTML = "";
							yours.innerHTML="<h2><font color=\"red\">Your answer has been submitted</font></h2>";
							var ajax2 = new  XMLHttpRequest();
							ajax.onreadystatechange = function() {
								
								if (ajax2.readyState == 4 && ajax2.status == 200) {
									samtext= ajax2.responseText;
									alert(samtext);
								}
								
							};
							ajax2.open("GET", "forumsub.php?qid="+x+"&mydata="+mydata+"&myname="+"<?=$full?>", true);
							ajax2.send();
							
							
						}
						
						
					};
					
					
					
				}
			};
			ajax.open("GET", "forumget.php?qid="+x, true);
			ajax.send();

		}
	
	
	</script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<style>
table, th, td {
    border: 1px solid black;
}
</style>
    <title>Forum</title>
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>




<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">iGroupsMaker</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="userprofile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li><a href="login.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                         <li>
                            <a href="creategroup.php"><i class="fa fa-edit fa-fw"></i> Create Group</a>
                        </li>
                        <li>
                            <a href="joingroup.php"><i class="fa fa-table fa-fw"></i> Join Group</a>
                        </li>
                         <li>
                            <a href="mygroups.php"><i class="fa fa-group"></i> My Groups</a>
                        </li>
                         
                         <li>
                            <a href="myprojects.php"><i class="fa fa-folder"></i> My Projects</a>
                        </li>
                        <li>
                            <a href="forum.php"><i class="fa fa-comments"></i> Forum</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Forum</h1>
                    </div>
                    <!-- page content here-->
					<div>
						<div id="questionask">
							<h2>You can start your own discussion</h2><br>
							<input id="questitle" type="text" name="title" placeholder="title"><br><br>
							<h4>Your Question:</h4>
							<textarea id="quesid" rows="4" cols="50" placeholder="Enter your question here"></textarea><br>
							<button id="subques">Submit question</button>
						</div>
					<?php 
                    print "<h3>Available Discussions in the forum</h3><h4>(Click on the row to check the question)</h4><br>";
					//print $full;
					//print $fname;
					/////////////////////////////////////Connect to Database///////////////////

	
					/////////////////////////////////////////////////////////////////////////////
					
					?>
					<div  id ="dumpdiv">
					<table >
					  <col width="130">
					<col width="130">
					
					<tr>
						<td>id</td>
						<td>Topic Title</td>
						<td>Number of Replies</td>
						
					</tr>
					<?php 
						$sql = $handler ->query ("SELECT * FROM questions");
						foreach ($sql as $row){
							$title = $row['title'];
							$rep = $row ['replies'];
							$myid = $row['id'];
							?>
							<tr onclick="trigger(<?=$myid?>)">
								<td><?=$myid?></td>
								<td ><?=$title?></td>
								<td><?=$rep?></td>
							</tr>
							<?php
							
						}
						
					
					?>
					
					</div>
					
					
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
