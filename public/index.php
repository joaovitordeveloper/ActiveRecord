<?php

use app\database\activerecord\Find;
use app\database\activerecord\Insert;
use app\database\activerecord\Update;
use app\database\models\User;

require "../vendor/autoload.php";

$user = new User;

$user->firstName = 'João Vitor';
$user->lastName = 'Pimentel';

$user->execute(new Update('id', 1));//valores de no where da query