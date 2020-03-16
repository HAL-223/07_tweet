<!-- 記事編集ページ -->
<?php

require_once('config.php');
require_once('functions.php');

$id = $_GET['id'];

$dbh = connectDb();
$sql = "select * from tweets where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$tweet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tweet) {
  header('Location: index.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $content= $_POST['content'];
  $errors = [];

  if ($content == '') {
    $errors['content'] = 'ツイート内容が未入力です';
  }

  if ($content === $tweet['content']) {
    $errors['content'] = '変更されておりません';
  }

  if (empty($errors)) {
    $dbh = connectDb();
    $sql = "update tweets set content = :content, created_at = now() where id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":content", $content);
    $stmt->execute();
    
    header('Location: index.php');
    exit;
  }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=
  , initial-scale=1.0">
  <title>編集画面</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Tweetを編集する</h1>
  <p><a href="index.php">戻る</a></p>
  <?php if ($errors) : ?>
    <ul class="error-list">
      <?php foreach ($errors as $error) : ?>
        <li>
          <?php echo h($error); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <form action="" method="post">
    <p>
      <label for="content">本文</label><br>
        <textarea name="content" id="" cols="50" rows="10" value="<?php echo h($tweet['content']); ?>"></textarea>
    </p>
    <p><input type="submit" value="編集する"></p>
  </form>
  </body>
</html>
