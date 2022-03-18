<?php
include 'db.php';
session_start();
$name = $_SESSION['name'];

$number = $_GET[ 'n' ];

$query = "SELECT * FROM questions WHERE question_number = $number";

$result = mysqli_query( $connection, $query );
$question = mysqli_fetch_assoc( $result );

$query = "SELECT * FROM options WHERE question_number = $number";
$choices = mysqli_query( $connection, $query );

$query = "SELECT * FROM questions";
$total_questions = mysqli_num_rows( mysqli_query( $connection, $query ) );

?>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Questions | WebbiSkools Ltd</title>
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
        <!-- Build the questions page -->
        <main>
            <div class="panel">
                <div class="container"></br>
                    <div class="current">Question <?php echo $number; ?> of <?php echo $total_questions; ?> </div></br>
                    <p class="question"><?php echo $question[ 'question_text' ]; ?></p>
                    <form method="POST" action="process.php">
                        <ol class="choicess">
                            <?php while( $row=mysqli_fetch_assoc( $choices ) ) { ?>
                            <li><input type="radio" name="choice" value="<?php echo $row[ 'id' ]; ?>"><?php echo $row[ 'text' ]; ?></li>
                            <?php } ?>   
                        </ol></br>
                        <input type="hidden" name="number" value="<?php echo $number; ?>">
                        <input class="btn btn-primary" role="button" type="submit" name="submit" value="Submit">
                    </form>
                <div>
            </div>    
        </main>
    </body>
</html>                
