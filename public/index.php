<?php

use app\database\activerecord\Delete;
use app\database\activerecord\Find;
use app\database\activerecord\FindAll;
use app\database\activerecord\FindBy;
use app\database\activerecord\Insert;
use app\database\activerecord\Update;
use app\database\models\User;

require "../vendor/autoload.php";

$user = new User;

/* $user->firstName = 'João';
$user->lastName = 'manuel'; */

var_dump($user->execute(new Insert()));//valores de no where da query