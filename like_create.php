<?php
include('functions.php');

$user_id = $_GET['user_id'];
$user_id = $_GET['user_id'];

$pdo = connect_to_db();

$sql = 'SELECT COUNT(*) FROM like_table WHERE user_id=:user_id AND user_id=:user_id';


$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$like_count = $stmt->fetchColumn();
// まずはデータ確認
// var_dump($like_count);
// exit();

if ($like_count != 0) {
  // いいねされている状態
  $sql = 'DELETE FROM like_table WHERE user_id=:user_id AND user_id=:user_id';
} else {
  // いいねされていない状態
  $sql = 'INSERT INTO like_table (id, user_id, user_id, created_at) VALUES (NULL, :user_id, :user_id, sysdate())';
}

// 以下は前項と変更なし
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:user_read.php");
exit();

