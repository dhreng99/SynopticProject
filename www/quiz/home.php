<?php
    include_once 'db.php';
    session_start();
    if(!(isset($_SESSION['email'])))
    {
        header("location:welcome.php");
    }
    else
    {
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        include_once 'db.php';
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Home | WebbiSkools Ltd</title>
        <link  rel="stylesheet" href="css/bootstrap.min.css"/>
        <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
        <link rel="stylesheet" href="css/welcome.css">
        <link  rel="stylesheet" href="css/font.css">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
    </head>
    <!-- Build the homepage -->
    <body>
        <nav class="navbar navbar-default title1">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand"><b>Quiz System</b></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="home.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li <?php echo''; ?> > <a href="logout.php?q=welcome.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>       
        <main>
            <div>
                <!-- Only allow User level users to access Take Quiz. The others can see everything -->
                <a href="main.php" class="btn btn-primary btn-lg" role="button">Take Quiz</a>
                <?php if( $name == "Admin" || $name == "Operator" ){echo'
                <a href="addquestion.php" class="btn btn-success btn-lg" role="button">Add Questions</a>
                <a href="edit.php" class="btn btn-warning btn-lg" role="button">Edit Quiz Question</a>
                <a href="delete.php" class="btn btn-danger btn-lg" role="button">Delete Quiz Questions</a>
                <a href="answers.php" class="btn btn-danger btn-lg" role="button">Delete Quiz Answers</a>
                ';}?>
            </div>
        </main>
    </body>
</html>