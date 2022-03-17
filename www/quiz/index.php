<?php
  include 'db.php';
  session_start();

  // var_dump($_GET);

  if(isset($_SESSION['key']))
  {
      if(@$_GET['q'] == 'delquiz' && $_SESSION['key'] == 'admin') 
      {
          $question_number = @$_GET['question_number'];
          $deleteq = mysqli_query($connection, "DELETE FROM questions WHERE question_number='$question_number' ") or die('Error');
          $deleteo = mysqli_query($connection, "DELETE FROM options WHERE question_number='$question_number' " ) or die('Error');
          if ( $question_number == '1' ){
            $q1 = mysqli_query($connection, "UPDATE questions SET question_number = question_number - 1 WHERE questions . question_number >= 2" ) or die( 'Error');
            $o1 = mysqli_query($connection, "UPDATE options SET question_number = question_number - 1 WHERE options . question_number >= 2" ) or die( 'Error');
          } else {
            $questions = mysqli_query($connection, "UPDATE questions SET question_number = question_number - 1 WHERE questions . question_number > 2" );
            $options = mysqli_query($connection, "UPDATE options SET question_number = question_number - 1 WHERE options . question_number > '$question_number'" );
          }
          header("location:delete.php");
      }

      if(@$_GET['q'] == 'delans' && $_SESSION['key'] == 'admin') 
      {
          $id = @$_GET['id'];
          $deletea = mysqli_query($connection, "DELETE FROM options WHERE id='$id' ") or die('Error');
          header("location:answers.php");
      }  
  }
?>  