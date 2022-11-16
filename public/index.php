<?php

use app\database\activerecord\Update;
use app\database\models\User;

require "../vendor/autoload.php";

$user = new User;

$user->nome = 'teste';
$user->sobrenome = 'testando';
$user->id = 1;

$user->update(new Update);