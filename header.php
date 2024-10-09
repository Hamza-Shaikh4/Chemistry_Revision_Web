<?php
  if(session_id() == '') {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"> <!-- set characters -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- scale to device -->
    <title>Chemistry Revision</title>
    <link rel="stylesheet" href="css/reset.css"> 
    <link rel="stylesheet" href="css/menu.css"> <!-- link to main css code -->
</head>

<body>
  <header>
    <nav>
      <div class="title">Chemistry Revision</div>
      <ul class="nav-options">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <?php
          if (isset($_SESSION["userid"])) {
            echo "<li><a href='profile.php'>Profile Page</a></li>";
            echo "<li><a href='includes/logout.inc.php'>Log Out</a></li>";
          }
          else {
            echo "<li><a href='signup.php'>Sign Up</a></li>";
            echo "<li><a href='login.php'>Login</a></li>";

          }
        ?>
      </ul>
    </nav>
  </header>

</body>

</html>