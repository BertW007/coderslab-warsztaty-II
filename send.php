<?php
require_once "library.php";
session_start();

//strona do wysyłania wiadomości do użytkownika o danym ID
if (isset($_SESSION["logged"])) {

    $userId = $_SESSION["logged"];
    $user = User::loadUserbyID($conn, $userId);
    $usemail = $user->getEmail();
    $username = $user->getUsername();
    // proste menu (powinno być osobno )
    echo "  witaj ";
    echo "<a href = main.php>$username</a>";
    echo " &nbsp &nbsp // &nbsp &nbsp";
    echo "<a href = login.php>wyloguj sie</a>";
    echo " &nbsp &nbsp // &nbsp &nbsp";
    echo "<a href = usersearch.php>szukaj użytkownikow</a>";
    echo " &nbsp &nbsp // &nbsp &nbsp";
    echo "<a href = messages.php>wiadomości</a>";
    echo "<hr>";


    /*
     * przypisanie id użytkownika z get do naszego - aby strona nie wyrzucała błędu
     * w takim wypadku wysyłamy wiadomość do samego siebie
     */
    $id = $userId;

    if (isset($_GET["name"]) == true){
        $id = trim($_GET["name"]);
    }


    $user = User::loadUserbyID($conn, $id);

    echo "Do : ", $user->getUsername();
    echo "<br>";

    ?>

    <form action="#" method="post">
        <textarea name="text" rows="4" cols="40" maxlength="140"></textarea><br>
        <input type="submit" value="wyślij wiadomość">
    </form>
<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["text"]) == true) {
            $text = $_POST["text"];
            $date = new DateTime();
            $date = $date->format("Y-m-d H:i:s");
        }
        $message = new Message();
        $message->setSenderId($userId);
        $message->setReceiverId($id);
        $message->setText($text);
        $message->setDate($date);
        var_dump($message);
        $message->sendMessage($conn);
    }
}
else {
    header("Refresh:0 ;url = login.php");
}


