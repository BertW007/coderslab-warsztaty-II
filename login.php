<?php
//jeżeli wejdziemy na stronę to nas wyloguje (usunie sesje)
session_start();
if (isset($_SESSION["logged"])) {
    unset($_SESSION["logged"]);
}

// jezeli nie jestes zalogowany to sie zaloguj
if (!isset($_GET["action"])==true && !isset($_SESSION["logged"])) {
    ?>
    <form action = "signin.php" method="post">
        <p>email</p>
        <input type = "text" name ="email">
        <p>hasło</p>
        <input type = "password" name = "password"><br>
        <input type =submit value="zaloguj">
    </form>
    <p>Jeżeli nie masz konta <a href="signup.php">utwórz</a> je  </p>

    <?php
}

?>







