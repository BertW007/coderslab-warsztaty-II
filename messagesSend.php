<?php

session_start();
require_once "library.php";
//sprawdzamy czy jest sesja jezeli tak to ladujemy strone glowna

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


    echo "<a href = messages.php>skrzynka odbiorcza</a> // ";
    echo "<a href = messagesSend.php>skrzynka nadawcza</a>";
    echo "<hr>";
    echo "<hr>";

    //załadowanie wysłanych wiadomosci po naszym ID
    $messages = Message::loadSendMessages($conn,$userId);

    //wyswietlenie tych wiadomosci
    foreach ($messages as $row){

        //załadowanie id użytkownika do którego wysłalismy wiadomosc
        $receiverID = intval ($row->getReceiverId());

        //załadowanie jego nazwy
        $receiverName = User::getUserNameByID($conn,$receiverID);
        echo "Nadawca : ";
        echo $username;
        echo "<br>";
        echo "Odbiorca : ";
        echo $receiverName;
        echo "<br>";
        echo "Tekst :";
        echo $row->getText();
        echo "<br>";
        echo "Data :";
        echo $row->getDate();
        echo "<hr>";
    }
}
else {
    header("Refresh:0 ;url = login.php");
}


?>


