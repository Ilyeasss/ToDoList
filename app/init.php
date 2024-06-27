<?php
session_start();


$host = "localhost";
$port = 3306;
$username = "root";
$password = "";
$dbname = "todo_list";

$dsn = "mysql:host=$host;port=$port;dbname=$dbname";

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];

  $pdo = new PDO($dsn, $username, $password, $options);
