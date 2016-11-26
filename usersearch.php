<?php
session_start();
require_once "library.php";
if (isset($_SESSION["logged"])) {
    //i ładujemy użytkownika z bazyt
    $userId = $_SESSION["logged"];
    $user = User::loadUserbyID($conn, $userId);
    $usemail = $user->getEmail();
    $username = $user->getUsername();
    echo "  witaj ";
    echo "<a href = main.php>$username</a>";
    echo " &nbsp &nbsp // &nbsp &nbsp";
    echo "<a href = login.php>wyloguj sie</a>";
    echo " &nbsp &nbsp // &nbsp &nbsp";
    echo "<a href = usersearch.php>szukaj użytkownikow</a>";
    echo " &nbsp &nbsp // &nbsp &nbsp";
    echo "<a href = messages.php>wiadomości</a>";
    echo "<hr>";
    ?>
    <form action="#" method="post">
        <p>wyszukaj użytkownika</p>
        <input type=text name=username>
        <input type="submit">
    </form>

    <?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["username"]) == true) {
            $search = trim ("'%".$_POST["username"]."%'");
            $result = User::searchUser($conn,$search);

            foreach ($result as $row){
                $id = $row->getId();
                    echo $row->getUsername()," / ";
                    echo "<a href = users.php?name=$id>profil</a> / ";
                    echo "<a href = send.php?name=$id>napisz wiadomość</a>";
                    echo "<hr>";
            }

        }
    }
}
else {
    header("Refresh:0 ;url = login.php");
}