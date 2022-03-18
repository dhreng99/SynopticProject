<?php
include 'db.php';
session_start();
$name = $_SESSION['name'];
?>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Delete Answer | WebbiSkools Ltd</title>
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
        <!-- Build answers page -->
        <?php
        {
            $result = mysqli_query($connection, "SELECT * FROM options" ) or die('Error');
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
                                            <b>Question Text</b>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <b>Answers</b>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <b>Correct Answer?</b>
                                        </center>
                                    </td>
                                    <td>
                                        <center>
                                            <b>Delete?</b>
                                        </center>
                                    </td>    
                                </tr>';
            $i=1;
            /* Get necessary data for table and alter 1's and 0's to Yes and No */
            while($row = mysqli_fetch_array($result)) {
                $question_number = $row['question_number'];
                $answer = $row['text'];
                $id = $row[ 'id' ];
                $correct_answer = $row[ 'is_correct' ];
                if( $correct_answer == '1' ){
                    $correct_answer = 'Yes';
                } else {
                    $correct_answer = 'No';
                }
                $questions = mysqli_fetch_array( mysqli_query( $connection, "SELECT * FROM questions WHERE question_number='$question_number'" ) ) or die( 'Error' );
                $question_text = $questions[ 'question_text' ];
                echo            '<tr>
                                    <td hidden>
                                        <center>'.$id.'</center>
                                    </td>
                                    <td>
                                        <center>'.$question_number.'</center>
                                    </td>
                                    <td>
                                        <center>'.$question_text.'</center>
                                    </td>
                                    <td>
                                        <center>'.$answer.'</center>
                                    </td>
                                    <td>
                                        <center>'.$correct_answer.'</center>
                                    </td>
                                    <td>
                                        <center>
                                            <b>
                                            '?>
                                            <!-- Only allow an Admin to delete answers -->
                                            <?php if( $name == "Admin" ){echo'
                                                <a href="index.php?q=delans&id='.$id.'" class="pull-right btn sub1" style="margin:0px;background:red;color:black">
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
        </main>
    </body>
</html>