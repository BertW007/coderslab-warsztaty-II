<?php

session_start();
require_once "library.php";
//sprawdzamy czy jest sesja jezeli tak to ladujemy strone glowna

if (isset($_SESSION["logged"])) {
    //i ładujemy użytkownika z bazyt
    $userId = $_SESSION["logged"];
    $user = User::loadUserbyID($conn,$userId);
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
        <textarea name="text" rows="4" cols="40" maxlength="140"></textarea><br>
        <input type="submit" value="tweetnij">
    </form>

    <?php
    //jezeli dodalismy tweeta

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["text"]) == true) {
            $text = $_POST["text"];
            $date = new DateTime();
            $date = $date->format("Y-m-d H:i:s");
        }
        $tweet = new Tweet();
        $tweet->setUserID($userId);
        $tweet->setText($text);
        $tweet->setDate($date);
        $tweet->setInsertUser($userId);
        $tweet->saveToDB($conn);
    }

    //załadowanie tweetów użytkownika
    $tweety = Tweet::loadTweetByUser($conn, $userId);

    //wyświetlenie tweetów
    foreach ($tweety as $record) {
        // id użytkownika który dodał tweeta
        $insertid = $record->getInsertUser();

        //pobranie nazwy użytkownika który dodał tweeta
        $insertName = User::getUserNameByID($conn,$insertid);
        echo "Dodany przez :";
        echo  "<a href = users.php?name=$insertid>$insertName</a>";
        echo "<br>";
        echo $record->getText();
        echo "<br>";
        echo $record->getDate();
        $tweetID = $record->getID();
        echo "<br>";
        echo "<hr>";

    }

}
else {
    header("Refresh:0 ;url = login.php");
}


?>


