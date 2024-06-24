<?php
session_start();




$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=todo_list;host:localhost', 'root', '');

if(!isset($_SESSION['user_id'])){
  die('You must sign in');
};