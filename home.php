<?php
session_start();

if (!isset($_SESSION['userid'])) {
  header('location: login.php');
}

// Include the header on the page
include_once 'header.php';

// Connect to the database
include_once 'includes/dbh.inc.php';

// Get a maximum of 3 topic IDs
$sql = "SELECT id FROM topics ORDER BY RAND() LIMIT 3";
$result = mysqli_query($conn, $sql);
$topic_ids = array();
while ($row = mysqli_fetch_assoc($result)) {
  $topic_ids[] = $row['id'];
}

// Pick a maximum of 10 random questions for the selected topics
$questions = array();
foreach ($topic_ids as $topic_id) {
  $sql = "SELECT * FROM questions WHERE topic_id = $topic_id ORDER BY RAND() LIMIT " . floor(10 / count($topic_ids));
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
  }
}
shuffle($questions); // randomize the order of the questions
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <style type="text/css">
    .option {
      margin: 10px 0;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      cursor: pointer;
    }

    .option label {
      margin-left: 10px;
    }

    .option.selected {
        background-color: #eee;
    }

    #submit-btn {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 12px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 20px;
        border-radius: 10px;
        cursor: pointer;
    }

    #submit-btn:hover {
        background-color: #3e8e41;
    }
  </style>

<!-- clickable answer box -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('.option').click(function() {
        $(this).siblings('.option').removeClass('selected');
        $(this).toggleClass('selected');
        $(this).children('input[type=checkbox]').prop('checked', $(this).hasClass('selected'));
      });
    });
  </script>

<!-- timer -->
  <script type="text/javascript">
    function timeout() {
      var minute = Math.floor(timeLeft / 60);
      var second = timeLeft % 60;
      if (timeLeft <= 0) {
        clearTimeout(tm);
        document.getElementById('myForm').submit();
      } else {
        document.getElementById("time").innerHTML = minute + ":" + second;
      }
      timeLeft--;
      var tm = setTimeout(function () {
        timeout()
      }, 1000);
    }
  </script>

</head>
<body onload="timeout()">
<div class="container">
  <br>

  <h1 class="text-center text-primary">Chemistry Quiz 
    <script type="text/javascript">
      var timeLeft = 300;
    </script>
    <div id="time" style="float:right">timeout</div>
    </h1><br>
    <h2 class="text-center text-success">Welcome </h2><br>

<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 m-auto d-block">

  <div class="card">
    <h3 class="text-center card-header">Welcome you have to select only one out of the four options. Best of Luck :)</h3>
  </div><br>

  <form action="check.php" id="myForm" method="post">

  <?php
    foreach ($questions as $question) {
        $qid = $question['id'];
        $qtext = $question['question'];
        $options = array(
        array('id' => 'answer_a', 'text' => $question['answer_a']),
        array('id' => 'answer_b', 'text' => $question['answer_b']),
        array('id' => 'answer_c', 'text' => $question['answer_c']),
        array('id' => 'answer_d', 'text' => $question['answer_d'])
        );
        shuffle($options); // randomize the order of the options
    ?>

    <div class="question">
        <h3><?php echo $qtext ?></h3>
        <?php
        foreach ($options as $option) {
            $oid = $option['id'];
            $otext = $option['text'];
        ?>
        <div class="option">
            <input type="checkbox" id="<?php echo $oid . '_' . $qid ?>" name="answer_<?php echo $qid ?>" value="<?php echo $otext ?>">
            <label for="<?php echo $oid . '_' . $qid ?>"><?php echo $otext ?></label>
        </div>
        <?php
        }        
        ?>
    </div> 
    <?php
    }
    ?>

  
      <input type="submit" value="Submit" id="submit-btn">
  
    </form>
  
  </div>
  </div>
  
  </body>
  </html>
  
