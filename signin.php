<?php
/*
 * strona która sprawdza poprawnośc loginu - aby nie zasmiecac pliku main
 */
require_once "library.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) == true) {
        if (isset($_POST["password"]) == true) {
            $email = $_POST["email"];
            $pass = $_POST["password"];
            $user = User::loadUserbyEmail($conn, $email);
            //jezeli nie ma uzytkownika to wartosc bedzie pusta i wyswietli sie komunikat i przekierowanie do strony logowania
                if ($user == false ){
                    echo "niepoprawny login lub hasło";
                    header("Refresh:2 ;url = login.php");

                }
                else {
                    //jezeli jest uzytkownik to sprawdzamy hasło
                    if ($user->getPassword()==$pass){
                        echo "zostałeś zalogowany. zaraz zostaniesz przekierowany na stronę główną";
                        session_start(); //tworzymy sesje aby mozna bylo przechodzic miedzy stronami
                        $_SESSION["logged"] = $user->getId();
                        header("Refresh:2 ;url = main.php");
                    }
                    else {
                        echo "niepoprawny login lub hasło";
                        header("Refresh:2 ;url = login.php");
                    }
                }


        }
    }


}