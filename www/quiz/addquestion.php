<?php include 'db.php';
session_start();
$name = $_SESSION['name'];
if( isset( $_POST[ 'submit' ] ) ){
    $question_number = $_POST[ 'question_number' ];
    $question_text = $_POST[ 'question_text' ];
    $correct_option = $_POST[ 'correct_option' ];
    /* Get each of the options and insert into array*/
    $option = array();
    $option[ 1 ] = $_POST[ 'option1' ];
    $option[ 2 ] = $_POST[ 'option2' ];
    $option[ 3 ] = $_POST[ 'option3' ];
    $option[ 4 ] = $_POST[ 'option4' ];
    $option[ 5 ] = $_POST[ 'option5' ];

    $query = "INSERT INTO questions (";
    $query .= "question_number, question_text )";
    $query .= "VALUES (";
    $query .= " '{$question_number}', '{$question_text}' ";
    $query .= ")";

    $result = mysqli_query( $connection, $query );
    /* Cycle through each option and insert into the table */
    if( $result ){
        foreach( $option as $select => $value ){
            if( $value != "" ){ 
                if( $correct_option == $select ){
                    $is_correct = 1;
                } else {
                    $is_correct = 0;
                }
                
                $query = "INSERT INTO options (";
                $query .= "question_number, is_correct, text)";
                $query .= " VALUES (";
                $query .= "'{$question_number}', '{$is_correct}', '{$value}'";
                $query .= ")";

                $insert_row = mysqli_query( $connection, $query );
                
                if( $insert_row ){
                    continue;
                } else {
                    die( "2nd query could not be executed " . $query ); 
                }
            }
        }
        $message = "Question has been successfully added";
    }
}
$query = "SELECT * FROM questions";
$questions = mysqli_query( $connection, $query );
$total = mysqli_num_rows( $questions );
$next = $total + 1;

?>
<html>
    <head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Add Questions | WebbiSkools Ltd</title>
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
            <div class="container">
                <div class="row"><span class="title1" style="margin-left:40%;font-size:30px;color:#fff;"><b>Enter Quiz Questions</b></span><br /><br />
                        <div class="col-md-3"></div><div class="col-md-6"> 
                <?php if( isset( $message ) ){
                    echo "<h4>" . $message . "</h4>";
                } ?>
                <form class="form-horizontal title1" method="POST" action="addquestion.php">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Question number:</label>
                                <input class="form-control input-md" type="number" name="question_number" min="1" max="999" value="<?php echo $next; ?>">
                            </div>    
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Question Text:</label>
                                <input class="form-control input-md" placeholder="Enter question text" type="text" name="question_text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">        
                                <label>Option 1:</label>
                                <input class="form-control input-md" placeholder="Enter option 1" type="text" name="option1">
                            </div>
                        </div>        
                        <div class="form-group">
                            <div class="col-md-12">        
                                <label>Option 2:</label>
                                <input class="form-control input-md" placeholder="Enter option 2" type="text" name="option2">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">        
                                <label>Option 3:</label>
                                <input class="form-control input-md" placeholder="Enter option 3" type="text" name="option3">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">        
                                <label>Option 4:</label>
                                <input class="form-control input-md" placeholder="Enter option 4" type="text" name="option4">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">        
                                <label>Option 5:</label>
                                <input class="form-control input-md" placeholder="Enter option 5" type="text" name="option5">
                            </div>
                        </div>
                        <label>Correct Option Number</label>
                        <select placeholder="Choose correct answer " type="number" class="form-control input-md" name="correct_option" >
                            <option value="1"> Option 1 </option>
                            <option value="2"> Option 2 </option>
                            <option value="3"> Option 3 </option>
                            <option value="4"> Option 4 </option>
                            <option value="5"> Option 5 </option>
                        </select>
                        <!-- Only let an Admin add new question -->
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