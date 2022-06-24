<?php
session_start();
include("functions.php");
check_session_id();

if (
  !isset($_POST['user']) || $_POST['user'] == '' ||
  !isset($_POST['deadline']) || $_POST['deadline'] == '' ||
  !isset($_POST['id']) || $_POST['id'] == ''
) {
  exit('paramError');
}

$user = $_POST["user"];
$deadline = $_POST["deadline"];
$id = $_POST["id"];

$pdo = connect_to_db();

$sql = "UPDATE user_table SET user=:user, deadline=:deadline, updated_at=now() WHERE id=:id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user', $user, PDO::PARAM_STR);
$stmt->bindValue(':deadline', $deadline, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:user_read.php");
exit();
