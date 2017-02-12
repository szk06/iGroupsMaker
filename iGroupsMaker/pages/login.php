<?php 
session_start();
if(isset($_SESSION['first_name'])) {
    session_destroy(); 
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

    <title>iGroupsMaker Login</title>

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
    <script>
    function validate(){
        var email= document.getElementById("email");
        var pass = document.getElementById("pass");
        var passnext =true;
        if(email.value==""|| email.value==null )
        {
            var x= document.getElementById("emailerror");
            x.innerHTML ="Email is empty";
            email.style='border:2px solid red';
            passnext = false;
        }
        else {
            var x= document.getElementById("emailerror");
            x.innerHTML ="";
            email.style='border:0.5px solid white';
        }
        if(pass.value==""|| pass.value==null){
            var y = document.getElementById("passerror");
            y.innerHTML="Password is empty";
            pass.style='border:2px solid red';
            passnext = false;
        }
        else{
            var y = document.getElementById("passerror");
            y.innerHTML="";
            pass.style='border:0.5px solid white';
        
        }
        if(passnext==false){
            return false;
        }
    }
    
    </script>

    <style type="text/css">
        span.formerror{
        color:red;
        font-size:12pt;
        font-weight: bold;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="row">
            <h2 class="btn btn-lg btn-success btn-block" >Welcome to iGroupsMaker - Your Favorite Group Projects Manager</h2>
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action="handlelogin.php" onsubmit="return validate()">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" id="email" name="email" type="email" autofocus>
                                    <span id="emailerror" class="formerror"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="pass" name="password" type="password" value="">
                                <span id="passerror" class="formerror"></span>
                                </div>

                                
                                <input type="submit" value="Login" class="btn btn-lg btn-success btn-block"><br>
								<div>Not registered? <a href="signup.html">Sign Up Now!</a>
								
								</div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
