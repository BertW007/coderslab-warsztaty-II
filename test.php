<?php
require_once "library.php";
$search = 27;
echo(User::getUserNameByID($conn,$search));