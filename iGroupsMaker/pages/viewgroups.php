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

    <title>iGroupsMaker Welcome</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

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
                <a class="navbar-brand" href="admindashboard.php">iGroupsMaker</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                      <li><a href="viewuserprofile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
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
                            <a href="admindashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="viewgroups.php"><i class="fa fa-group"></i> View All Groups</a>
                        </li>
                        <li>
                            <a href="viewprojects.php"><i class="fa fa-folder"></i> View All Projects</a>
                        </li>


                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View All Groups</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- <h4>Here you will see all the groups and their corresponding projects</h4> -->
                <h4>The following are all the formed groups </h4>

                                    <?php 
                    // retreive the groups of the current student
                    $mysqlhost = "localhost";
                    $user= "root";
                    $dbname1 = "project";
                    $sqlpass='';
                    $handler = new PDO("mysql:host=$mysqlhost;dbname=$dbname1", $user, $sqlpass);
                    /////////////////////////////////////////////////
                    $studentid = $_SESSION['student_id'];
                    $row = $handler->query("SELECT DISTINCT gname2,gpassword  FROM members");
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
                        
                       // print "You currently don't have any group. Start by creating a group or by joining your friend's group by typing the group's password!";
                    }
                    else{
                        //print "<h3>You are currently enrolled in the following group(s):</h3><br>";
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
                
            </div>
            <!-- /.row -->
            
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
