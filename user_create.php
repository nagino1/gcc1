<?php
session_start();
include("functions.php");
check_session_id();

if (
  !isset($_POST['user']) || $_POST['user'] == '' ||
  !isset($_POST['deadline']) || $_POST['deadline'] == ''
) {
  exit('paramError');
}

$user = $_POST['user'];
$deadline = $_POST['deadline'];

$pdo = connect_to_db();

$sql = 'INSERT INTO user_table(id, user, deadline, created_at, updated_at) VALUES(NULL, :user, :deadline, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user', $user, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:user_input.php");
exit();
