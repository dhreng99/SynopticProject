<?php
session_start();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Finished | WebbiSkools Ltd</title>
        <link  rel="stylesheet" href="css/bootstrap.min.css"/>
        <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
        <link rel="stylesheet" href="css/welcome.css">
        <link  rel="stylesheet" href="css/font.css">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js"  type="text/javascript"></script>
    </head>
    <body>
        <!-- Build the final score page -->
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

        <main>
            <div class="panel">
                <div class="container">
                    <h2>Your Result</h2>
                    <p>Congrats you have completed this test</p>
                    <p>Your <strong>Score</strong> is <?php echo $_SESSION[ 'score' ]; ?></p>
                    <?php unset( $_SESSION[ 'score' ] ); ?>
                </div>    
            </div>    
        </main>
    </body>
</html>