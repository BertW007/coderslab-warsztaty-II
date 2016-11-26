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
    echo "<a href = messages.php.php>wiadomości</a>";
    echo " &nbsp &nbsp // &nbsp &nbsp";
    echo "<a href = messages.php>wiadomości</a>";
    echo "<hr>";

    $id = $userId;
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["name"]) == true) {
            $id = trim($_GET["name"]);
        }
    }
    var_dump($id);

    $user = User::loadUserbyID($conn, $id);
    echo $user->getUsername();
    echo "<br>";

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
        $tweet->setUserID($id);
        $tweet->setText($text);
        $tweet->setDate($date);
        $tweet->setInsertUser($userId);
        $tweet->saveToDB($conn);
    }


    $tweety = Tweet::loadTweetByUser($conn, $id);

    foreach ($tweety as $record) {
        $insertid = $record->getInsertUser();
        $insertName = User::getUserNameByID($conn, $insertid);
        echo "Dodany przez :";
        echo "<a href = users.php?name=$insertid>$insertName</a>";
        echo "<br>";
        echo $record->getText();
        echo "<br>";
        echo $record->getDate();
        $tweetID = $record->getID();
        echo "<br>";
        echo "<hr>";

    }
//        }
//    }


} else {
    header("Refresh:0 ;url = login.php");

}


