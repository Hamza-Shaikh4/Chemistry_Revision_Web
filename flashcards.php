<?php
    include_once 'header.php'; /* allow the header to be included on certain pages */
?>

<!DOCTYPE html>
<html>
<head>
  <title>Flashcard Revision Resource</title>
  <link rel="stylesheet" type="text/css" href="css/flashcards.css">
</head>
<body>
  <h1>Flashcard Revision Resource</h1>
  <div class="card-container">
    <div class="card-question"></div>
    <div class="card-answer hidden"></div>
  </div>
  <div class="button-container">
    <button class="back-button" disabled>Back</button>
    <button class="flip-button">Flip</button>
    <button class="next-button">Next</button>
  </div>
  <script src="flashcards.js"></script>
</body>
</html>