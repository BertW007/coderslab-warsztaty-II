<?php
//library
require_once "class/User.php";
require_once "class/Tweet.php";
require_once "class/Message.php";
$conn= (new mysqli( 'localhost',
    'root',
    '',
    'twitter')

);

?>