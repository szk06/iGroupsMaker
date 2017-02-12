<?php 
session_start();
if(!isset($_SESSION['first_name'])) {
    session_destroy();
    print "error! you need to login first";
    die; 
    //print"session destroyed";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Groups</title>
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
                        <h1 class="page-header">My Groups</h1>
                    </div>
                    <!-- page content here-->

                    

                    <?php 
                    // retreive the groups of the current student
                    $mysqlhost = "localhost";
                    $user= "root";
                    $dbname1 = "project";
                    $sqlpass='';
                    $handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
                    /////////////////////////////////////////////////
                    $studentid = $_SESSION['student_id'];
                    $row = $handler->query("SELECT DISTINCT gname2,gpassword  FROM members where studentid = '$studentid'");
                    $myid="";
                    $groups="";
                    $usergroups= array();
                    $passwords= array();
                    $password1="";
                    $count=0;
                    $countid=1;
                    // if u want to display them in a table, need array of courses, array of groups, and array of members for each group, then loop and display them in the table
                    
                    foreach($row as $elm){
                        $myid = $elm['gname2'];
                        $groups.=$myid."<br>";
                        array_push($usergroups, $myid);
                        $password1=$elm['gpassword'];
                        array_push($passwords, $password1);
                        //var_dump($passwords);

                        
                    }
                    if($myid == NULL){
                        
                        print "<h4>You currently don't have any group. Start by creating a group or by joining your friend's group by typing the group's password!</h4>";
                    }
                    else{
                        print "<h4>You are currently enrolled in the following group(s):</h4><br>";
                        //print "Members:<br>";
                        foreach($passwords as $elm){
                            // display table here
                            print '<div class="row"><div class="col-lg-6"><div class="panel panel-default"><div class="panel-heading">Group '.$usergroups[$count];//.' for the course '; ///</div>'



                            //print "Group ";
                            //print $usergroups[$count];
                                // show course///////////////////////////
                                $cname=$usergroups[$count];
                                $row = $handler->query("SELECT coursename FROM groups where gname = '$cname'");
                                $course="";
                                foreach($row as $elm4){
                                    $course = $elm4['coursename'];
                                }
                                print " for the course $course Members:</div>";

                                print '<!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>';


                                //////////////////////////////////////
                            //print "<br>";
                            //print "Members:<br>";
                            
                            $row = $handler->query("SELECT first_name,last_name FROM signed JOIN members on studentid=student_id JOIN groups on members.gpassword=groups.gpassword WHERE members.gpassword='$elm'");
                            $fname="";
                            $lname="";
                           // var_dump($row);
                            
                            foreach($row as $elm3){
                                $fname = $elm3['first_name'];
                                $lname = $elm3['last_name'];
                                //print "$fname $lname <br>";
                                print "<tr><td>$countid</td> <td>$fname</td><td>$lname</td></tr>";
                                $countid++;



                            }
                            $count++;
                            $countid=1;
                            //print "<br>";
                            //print 'trying out the " double quotes" ';
                            print '</tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
           </div>';
                        }

                    }
                    

                    ?>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <?php /*
                <!-- table -->
                <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Group webgroup1 members for the course CMPS 278
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Student1</td>
                                            <td>LastName1</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Student2</td>
                                            <td>LastName2</td>
                                            
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
           </div>*/?>




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
