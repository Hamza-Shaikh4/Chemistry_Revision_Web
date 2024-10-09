<?php
    include_once 'header.php';
?>

<div class="form-container">
    <section class="signup-form">
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email...">
            <input type= "password" name= "pwd" placeholder= "Password. . .">
            <button type="submit" name="submit">Log In</button>
        </form>
        <?php
            if (isset ($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Fill in all fields! </p> ";
                }
                else if ($_GET["error"] == "wronglogin" ) {
                    echo "<p>Incorrect login information! </p>";
                }
            }
        ?>
    </section>
</div>
