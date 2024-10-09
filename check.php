<?php
session_start();

if (!isset($_SESSION['userid'])) {
  header('location: login.php');
}

// Include the header on the page
include_once 'header.php';

// Connect to the database
include_once 'includes/dbh.inc.php';

// Initialize variables to keep track of the score
$score = 0;
$total_questions = 0;

// Loop through each submitted answer
foreach ($_POST as $key => $value) {
  if (strpos($key, 'answer_') !== false) {
    $qid = str_replace('answer_', '', $key);
    $user_answer = mysqli_real_escape_string($conn, $value);

    // Get the correct answer from the database
    $sql = "SELECT correct_answer FROM questions WHERE id = $qid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $correct_answer = $row['correct_answer'];

    // Check if the user's answer is correct
    if ($user_answer == $correct_answer) {
      $score++;
    }
    $total_questions++;
  }
}
// Calculate the percentage score
if ($total_questions > 0) {
    $percent = round($score / $total_questions * 100, 2);
  } else {
    $percent = 0;
  }
  
  // Display the results
  echo "<div class='container'>";
  echo "<br>";
  echo "<h1 class='text-center'>Quiz Results</h1><br>";
  echo "<h2 class='text-center'>You scored $score out of $total_questions</h2>";
  echo "<h2 class='text-center'>Percentage Score: $percent%</h2><br>";
  
  // Loop through each question and highlight the correct and incorrect answers
  foreach ($_POST as $key => $value) {
    if (strpos($key, 'answer_') !== false) {
      $qid = str_replace('answer_', '', $key);
      $user_answer = mysqli_real_escape_string($conn, $value);
  
      // Get the correct answer from the database
      $sql = "SELECT correct_answer FROM questions WHERE id = $qid";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $correct_answer = $row['correct_answer'];
  
      // Get the question text and options from the database
      $sql = "SELECT * FROM questions WHERE id = $qid";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $qtext = $row['question'];
      $options = array(
        array('id' => 'answer_a', 'text' => $row['answer_a']),
        array('id' => 'answer_b', 'text' => $row['answer_b']),
        array('id' => 'answer_c', 'text' => $row['answer_c']),
        array('id' => 'answer_d', 'text' => $row['answer_d'])
      );
  
      // Display the question text
      echo "<div class='question'>";
      echo "<h3>$qtext</h3>";
  
      // Loop through the options and highlight the correct and incorrect answers
      foreach ($options as $option) {
          $oid = $option['id'];
          $otext = $option['text'];
          $class = '';
          if ($otext == $correct_answer) {
          $class = 'bg-success';
          if ($user_answer == $otext) {
              $class .= ' text-white';
          }
          } elseif ($user_answer == $otext) {
          $class = 'bg-wrong';
          if ($user_answer != $correct_answer) {
              $class .= ' text-white';
          }
          }
      
          echo "<div class='form-check $class'>";
          echo "<input class='form-check-input' type='radio' name='answer_$qid' id='$oid' value='$otext' disabled>";
          echo "<label class='form-check-label' for='$oid'>$otext</label>";
          echo "</div>";
      }
    }
  }
  