<?php

use app\database\activerecord\Delete;
use app\database\activerecord\Find;
use app\database\activerecord\Insert;
use app\database\activerecord\Update;
use app\database\models\User;

require "../vendor/autoload.php";

$user = new User;

/* $user->firstName = 'João';
$user->lastName = 'manuel'; */

echo $user->execute(new Delete('id', '2'));//valores de no where da query