<?php
include 'db.php';
session_start();
$name = $_SESSION['name'];
// $query = "SELECT question_text FROM questions";
// $total_questions = mysqli_query( $connection, $query );
// $number = $_GET[ 'n' ];

// $query = "SELECT * FROM questions WHERE question_number = $number";

// $result = mysqli_query( $connection, $query );
// $question = mysqli_fetch_assoc( $result );

// $query = "SELECT * FROM options WHERE question_number = $number";
// $choices = mysqli_query( $connection, $query );

// $query = "SELECT * FROM questions";
// $total_questions = mysqli_num_rows( mysqli_query( $connection, $query ) );

?>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Delete Questions | WebbiSkools Ltd</title>
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
        <?php
        {
            $result = mysqli_query($connection, "SELECT * FROM questions" ) or die('Error');
            // $questions = mysqli_query($connection, "SELECT text FROM options" )or die('Error');
            echo   '<div class="panel">
                        <div class="table-responsive">
                            <table class="table table-striped title1">
                                <tr>
                                    <td>
                                        <center>
                                            <b>Question Number</b>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <b>Question</b>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <b>Delete?</b>
                                        </center>
                                    </tr>';
            $i=1;
            while($row = mysqli_fetch_array($result)) {
                $question_number = $row['question_number'];
                $question_text = $row['question_text'];
                echo            '<tr>
                                    <td>
                                        <center>'.$i++.'</center>
                                    </td>
                                    <td>
                                        <center>'.$question_text.'</center>
                                    </td>
                                    <td>
                                        <center>
                                            <b>
                                            '?>
                                            <?php if( $name == "Admin" ){echo'
                                                <a href="index.php?q=delquiz&question_number='.$question_number.'" class="pull-right btn sub1" style="margin:0px;background:red;color:black">
                                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                    &nbsp;
                                                    <span class="title1">
                                                        <b>Remove</b>
                                                    </span>
                                                </a>
                                            ';}?>
                                            <?php echo'    
                                            </b>
                                        </center>
                                    </td>
                                </tr>';
            }
            $i=0;
            echo '          </table>
                        </div>
                    </div>';
        }
        
        ?>
         <!-- <button class="accordion">Section 1</button>
            <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <button class="accordion">Section 2</button>
            <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>

            <button class="accordion">Section 3</button>
            <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div> 

            <script>
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                panel.style.display = "none";
                } else {
                panel.style.display = "block";
                }
            });
            }
            </script>       -->
        </main>
    </body>
</html>