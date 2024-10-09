document.addEventListener('DOMContentLoaded', function() {

    document.querySelector('.rectangle3').addEventListener('click', function() {
        location.href = "home.php";
    }); 

    document.querySelector('.rectangle4').addEventListener('click', function() {
        location.href = "videos.php";
    });

    document.querySelector('.rectangle5').addEventListener('click', function() {
        location.href = "notes.php";
    });

    document.querySelector('.rectangle6').addEventListener('click', function() {
        location.href = "flashcards.php";
    });

}, false);

