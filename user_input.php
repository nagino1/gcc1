<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <title>ユーザー入力画面（入力画面）</title>
</head>

<body>
  <form action="user_create.php" method="POST">
    <fieldset>
      <legend>ユーザー入力画面（入力画面）</legend>
      <a href="user_read.php">一覧画面</a>
      <a href="user_logout.php">logout</a>
      <div>
        name: <input type="text" name="user">
      </div>
      <div>
        <p>登録ビザ</p>
        <input type="radio" name="visa" value="特定技能">特定技能
        <input type="radio" name="visa" value="技能実習">技能実習
      </div>
      <div>
        <p>性別</p>
        <input type="radio" name="男">男
        <input type="radio" name="女">女
      </div>
      <div>
        <p>日本語レベル</p>
        <input type="radio" name="level">N1
        <input type="radio" name="level">N2
        <input type="radio" name="level">N3
        <input type="radio" name="level">N4
        <input type="radio" name="level">N5
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>