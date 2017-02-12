<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Join Group</title>
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

    <script type="text/javascript">
        window.onload=pageLoad;
        var passer = true;
        function pageLoad(){
            document.getElementById("gpassword").onblur = mycheck;
            
        }
        function mycheck(){
            var gpassword = document.getElementById("gpassword");
            var gpasswordval = gpassword.value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var mytext = xhttp.responseText;
                    //document.writeln(mytext);
                    if(mytext=="yes"){
                        passer = false;
                        var x = document.getElementById("epass1");
                        x.innerHTML = "No such password";
                        gpassword.style = 'border:2px solid red';  
                    }
                     
                    else{
                        passer = true;
                        var x = document.getElementById("epass1");
                        x.innerHTML = "";
                        gpassword.style = 'border:2px solid white';  
                    
                    }
                }                     
                    
                };
            
            xhttp.open("POST", "checkgpassword.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("gpassword="+gpasswordval); 
        
        }

        function validate(){
            var pass1 = document.getElementById("gpassword");
            var mypass1 = false;
            var passing = true;


            ///Password validation
            if(pass1.value=="" || pass1.value==null){
                var x = document.getElementById("epass1");
                x.innerHTML = "Password cannot be empty";
                pass1.style = 'border:2px solid red';
                passing = false;
            }else{
                
                
                var str  = pass1.value;
                //alert(str);
                var n = str.length;
                if(n<6){
                    //alert(pasval.length);
                    var x = document.getElementById("epass1");
                    x.innerHTML = "Length of Password should be at least 6 characters";
                    pass1.style = 'border:2px solid red';
                    passing = false;
                }else{
                    var x = document.getElementById("epass1");
                    x.innerHTML = "";
                    pass1.style = 'border:0.5px solid white';
                    mypass1 = true;
                    
                }
            }
            
            
            ////////////////////////////////////////

            //alert("passing"+passing);
            if(passing == false){
                    return false;
            }
            //alert("passer"+passer);
            if(passer == false){
                return false;
            }
        
        }
    
    
    
    </script>

    <style type="text/css">
        span.formerror {
        color:red;
        font-size:11pt;
        /*font-weight: bold;*/
        }
    </style>
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
                        <h1 class="page-header">Join Group</h1>
                    </div>
                    <!-- page content here-->

                    <div><h4>Please enter the password of the Group that you want to join (Make sure to ask your partner who created the group about the group password)</h4></div><br>


                    <form role="form" onsubmit= "return validate()" method="POST" action="handlejoingroup.php" id="myform">
                            <fieldset>

                    <div class="form-group">
                                            <label>Enter Group Password</label>
                                            <input class="form-control" id="gpassword" name="gpassword" placeholder="Group Password">
                                            <span id="epass1" class="formerror"></span>
                        </div>

                        <input type="submit" value="Join Group" class="btn btn-primary">

                        </fieldset>
                        </form>  


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
