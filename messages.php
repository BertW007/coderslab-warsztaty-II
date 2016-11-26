<?php

session_start();
require_once "library.php";
//sprawdzamy czy jest sesja jezeli tak to ladujemy strone glowna

if (isset($_SESSION["logged"])) {
    //i ładujemy użytkownika z bazy
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


    echo "<a href = messages.php.php>skrzynka odbiorcza</a> // ";
    echo "<a href = messagesSend.php>skrzynka nadawcza</a>";
    echo "<hr>";
    echo "<hr>";

    //załadowanie otrzymancych wiadomośći po naszym ID z sesji
    $messages = Message::loadReceivedMessages($conn,$userId);

    //wyświetlenie wiadomosci
    foreach ($messages as $row){
        $senderID = intval ($row->getSenderId());
        $senderName = User::getUserNameByID($conn,$senderID);
        echo "Nadawca : ";
        echo $senderName;
        echo "<br>";
        echo "Odbiorca : ";
        echo $username;
        echo "<br>";
        echo "Tekst :";
        echo $row->getText();
        echo "<br>";
        echo "Data :";
        echo $row->getDate();
        echo"<br>";
        echo "<a href = send.php?name=$senderID>odpisz</a>";
        echo "<hr>";

    }

}
//jeżeli nie jesteśmy zalogowani to przenosci na stronę logowania
else {
    header("Refresh:0 ;url = login.php");
}


?>


