<?php
include 'db.php';
$query = "SELECT * FROM questions";
$total_questions = mysqli_num_rows( mysqli_query( $connection, $query ) );
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Take Quiz | WebbiSkools Ltd</title>
        <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
        <link  rel="stylesheet" href="css/bootstrap.min.css"/>
        <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
        <link rel="stylesheet" href="css/welcome.css">
        <link  rel="stylesheet" href="css/font.css">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
    </head>    
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
                    <a class="navbar-brand" href="#"><b>Quiz System</b></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
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
        <div class="panel">
                    <!-- <table class="table table-striped title1" >
                    <tr style="color:red"><td><center><b>Rank</b></center></td><td><center><b>Name</b></center></td><td><center><b>Score</b></center></td></tr> -->
            <div class="container">
                <h2>Take the Quiz</h2>
                <hr>
                <ul>
                    <li><strong>Number of questions: </strong><?php echo $total_questions; ?></li>
                    <li><strong>Type:</strong>Multiple choice</li>
                </ul>
                <div class="form-group">
                    <label class="col-md-12 control-label" for=""></label>
                    <div class="col-md-12">        
                        <a href="question.php?n=1" class="btn btn-primary" role="button">Start quiz</a>
                    </div>
                </div>  
            </div>
        </main>    
    </body>    
</html>    