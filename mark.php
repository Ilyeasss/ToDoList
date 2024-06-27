<?php
require_once 'app/init.php';

if(isset($_GET['as'], $_GET['item'])){
  $as = $_GET['as'];
  $item = $_GET['item'];
  if($as == 'done'){
    $query = $pdo->prepare("
    UPDATE items
    SET done = 1
    WHERE id = :item
    AND user = :user
    ");
    $query->execute([
      ':item' => $item,
      ':user' => $_SESSION['user_id']
    ]);
  };
  if($as == 'notdone'){
    $query = $pdo->prepare("
    UPDATE items
    SET done = 0
    WHERE id = :item
    AND user = :user
    ");
    $query->execute([
      ':item' => $item,
      ':user' => $_SESSION['user_id']
    ]);
  }
};

header('Location: app.php');