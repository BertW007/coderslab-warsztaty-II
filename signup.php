form action = "#" method="post">
    <p>nazwa</p>
    <input type = "text" name = "username"><br>
    <p>email</p>
    <input type = "text" name = "email"><br>
    <p>hasło</p>
    <input type = "password" name = "password"><br>
    <input type="submit" value = "utworz">

</form>


<?php
 require_once "library.php";

session_start();
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if (isset($_POST["username"])== true){
        $username = $_POST["username"];
    }

    if (isset($_POST["email"])== true){
        $email = $_POST["email"];
    }

    if (isset($_POST["password"])== true){
        $password = $_POST["password"];
    }

    $user = new User();
    $user->setEmail($email);
    $user->setUsername($username);
    $user->setPassword($password);
    $user->saveToDB($conn);

   var_dump($user);

    if ($user->getId() != -1){
        echo "Konto zostało pomyślnie utworzone zaraz zostaniesz przekierowany na stronę główną";
        header("Refresh:2 ;url = main.php");
        $_SESSION["logged"] = $user->getId();
    }
    else {
        echo "Takie konto już istnieje. Wprowadz inny adres email";
    }

}
