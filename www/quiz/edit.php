<?php include 'db.php';
session_start();
$name = $_SESSION['name'];
error_reporting(E_ALL ^ E_NOTICE);
/* Get data to populate table when user clicks select question button*/
if( isset( $_POST[ 'enter' ] ) ){
    $edit_question = $_POST[ 'editq' ];
    $query = mysqli_query( $connection, "SELECT `text`, id FROM options WHERE question_number='$edit_question'" );
    for( $choice = array(); $row[ 'text' ] = mysqli_fetch_assoc( $query ); $choice[] = $row[ 'text' ] );
    $c1 = $choice[ 0 ];
    $c2 = $choice[ 1 ];
    $c3 = $choice[ 2 ];
    $c4 = $choice[ 3 ];
    $c5 = $choice[ 4 ];
}
/* Save changed data when user clicks submit button */
if( isset( $_POST[ 'submit' ] ) ){
    $selected_question = $_POST[ 'selected_question' ];
    $option = array();
    $option[ 1 ] = $_POST[ 'id1' ];
    $question_text = $_POST[ 'question_text' ];
    $correct_choice = $_POST[ 'correct_choice' ];

    $choice = array();
    $choice[ 1 ] = $_POST[ 'choice1' ];
    $choice[ 2 ] = $_POST[ 'choice2' ];
    $choice[ 3 ] = $_POST[ 'choice3' ];
    $choice[ 4 ] = $_POST[ 'choice4' ];
    $choice[ 5 ] = $_POST[ 'choice5' ];
    $query = mysqli_query( $connection, "UPDATE questions SET question_text = '{$question_text}' WHERE question_number = '{$selected_question}'" );
    if( $query ){
        foreach( $option as $key => $optionid ){
            foreach( $choice as $option => $value ){
                if( $value != "" ){ 
                    if( $correct_choice == $option ){
                        $is_correct = 1;
                    } else {
                        $is_correct = 0;
                    }
                    // $result = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM options WHERE question_number= '{$selected_question}'" ) ) or die('Error');
                    
                    // var_dump($is_correct);
                    // var_dump($value);
                    // var_dump($_POST['id1']);

                    /* This doesn't work yet */
                    $query1 = "UPDATE options SET is_correct = '{$is_correct}', `text` = '{$value}' WHERE id = '{$optionid}'";
                    // var_dump($query1);
                    // $query1.= "is_correct, text)";
                    // $query1 .= " VALUES (";
                    // $query1 .= "'{$is_correct}', '{$value}'";
                    // $query1 .= ")";

                    $insert_row = mysqli_query( $connection, $query1 );
                    // var_dump($insert_row);
                    if( $insert_row ){
                        continue;
                    } else {
                        die( "2nd query could not be executed " . $query1 ); 
                    }
                }
            $message = "Question has been successfully added";
            }
        }
    }
}
?>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Edit Questions | WebbiSkools Ltd</title>
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
        <!-- Build Edit Question page -->
        <main>
            <div class="container">
                <div class="row"><span class="title1" style="margin-left:40%;font-size:30px;color:#fff;"><b>Edit Quiz Questions</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6"> 
                <?php if( isset( $message ) ){
                    echo "<h4>" . $message . "</h4>";
                } ?>
                <form class="form-horizontal title1" method="POST" action="edit.php">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Select question number to Edit:</label>
                                <select class="form-control input-md" id="select1" name="editq"> 
                                    <?php 
                                        $question_number = mysqli_query( $connection, "SELECT * FROM questions" );
                                        while ( $row = mysqli_fetch_assoc( $question_number ) ){
                                            echo '<option value="' .$row[ 'question_number' ]. '">'.$row[ 'question_number' ].'</option>';
                                        }
                                    ?>
                                </select>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" for=""></label>
                                    <div class="col-md-12">        
                                        <button class="btn btn-primary btn-block" name="enter" onclick="TestsFunction()">Click to select question</button>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        <div id="TestsDiv">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Question Text:</label>
                                    <?php
                                    $question_text = mysqli_query( $connection, "SELECT * FROM questions WHERE question_number='$edit_question'" );
                                        while ( $row = mysqli_fetch_assoc( $question_text ) ){
                                            echo '<input class="form-control input-md" name="question_text" value="' .$row[ 'question_text' ]. '">';
                                        }
                                    ?>        
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <div class="col-md-12">        
                                    <label>Selected Question Number</label>
                                    <?php
                                    echo '<input class="form-control input-md" value="' .$edit_question. '" type="text" name="selected_question">'
                                    ?>
                                </div>
                            </div> 
                            <div class="form-group" hidden>
                                <div class="col-md-12">        
                                    <label>Choice 1:</label>
                                    <?php
                                    echo '<input class="form-control input-md" value="' .$c1[ 'text' ]. '" type="text" name="choice1">
                                          <input type="hidden" class="form-control input-md" value="' .$c1[ 'id' ]. '" type="text" name="id1">'
                                    ?>
                                </div>
                            </div>        
                            <div class="form-group" hidden>
                                <div class="col-md-12">        
                                    <label>Choice 2:</label>
                                    <?php
                                    echo '<input class="form-control input-md" value="' .$c2[ 'text' ]. '" type="text" name="choice2">'
                                    ?>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <div class="col-md-12">        
                                    <label>Choice 3:</label>
                                    <?php
                                    echo '<input class="form-control input-md" value="' .$c3[ 'text' ]. '" type="text" name="choice3">'
                                    ?>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <div class="col-md-12">        
                                    <label>Choice 4:</label>
                                    <?php
                                    echo '<input class="form-control input-md" value="' .$c4[ 'text' ]. '" type="text" name="choice4">'
                                    ?>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <div class="col-md-12">        
                                    <label>Choice 5:</label>
                                    <?php
                                    echo '<input class="form-control input-md" value="' .$c5[ 'text' ]. '" type="text" name="choice5">'
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div hidden>
                            <label>Correct Option Number</label>
                            <select type="number" class="form-control input-md" name="correct_choice">
                                <option value="" disabled selected>Select correct answer</option>
                                <option value="1"> Choice 1 </option>
                                <option value="2"> Choice 2 </option>
                                <option value="3"> Choice 3 </option>
                                <option value="4"> Choice 4 </option>
                                <option value="5"> Choice 5 </option>
                            </select>
                        </div>    
                        <?php if( $name == "Admin" ){echo'
                        <div class="form-group">
                            <label class="col-md-12 control-label" for=""></label>
                            <div class="col-md-12">        
                                <button class="btn btn-primary btn-block" name="submit">Submit</button>
                            </div>
                        </div>
                        ';}?>
                    </fieldset>    
                </form>                
            </div>  
        </main>
    </body>    
</html>