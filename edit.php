<!-- 記事編集ページ -->
<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];

$dbh = connectDb();
$sql  = "select * from tweets where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=
  , initial-scale=1.0">
  <title>編集画面</title>
</head>
<body>
  <h1>Tweetを編集する</h1>
  <p><a href="index.php">戻る</a></p>
  <form action="" method="post">
    <p>
      <label for="content">本文</label><br>
        <textarea name="content" id="" cols="50" rows="10"><?php echo h($tweet ['content']); ?></textarea>
    </p>
    <p><input type="submit" value="編集する"></p>
  </form>
  </body>
</html>
