<?php
require_once 'app/init.php';

if(isset($_POST['name'])){
  $name = trim($_POST['name']);
  if(!empty($name)){
    $query = $pdo->prepare("
    INSERT INTO items (name, user, done, created, important)
    VALUES (:name, :user, 0, NOW(), 0)
    ");
    $query->execute([
      'name' => $name,
      'user' => $_SESSION['user_id']
    ]);
  }
}

header('Location: app.php');
