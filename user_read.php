<?php
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

// $sql = "SELECT * FROM user_table ORDER BY deadline ASC";
$sql = 'SELECT * FROM user_table LEFT OUTER JOIN (SELECT user_id, COUNT(id) AS like_count FROM like_table GROUP BY user_id) AS result_table ON user_table.id = result_table.user_id';

$stmt = $pdo->prepare($sql);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}


$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output = "";

$user_id = $_SESSION['user_id'];
foreach ($result as $record) {
  $output .= "
    <tr>
      <td>{$record["deadline"]}</td>
      <td>{$record["user"]}</td>
      <td><a href='like_create.php?user_id={$user_id}&user_id={$record["id"]}'>like{$record["like_count"]}</a></td>
      <td><a href='user_edit.php?id={$record["id"]}'>edit</a></td>
      <td><a href='user_delete.php?id={$record["id"]}'>delete</a></td>
    </tr>
  ";
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">

  <title>ユーザーリスト（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>ユーザーリスト（一覧画面）</legend>
    <a href="user_input.php">入力画面</a>
    <a href="user_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>応募日</th>
          <th>name</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>