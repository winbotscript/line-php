<?php

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\TalkParticular();


$app->run();

//
// echo $time;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>line</title>
  <link rel="stylesheet" href="css/particularStyle.css">
</head>
<body>
  <header>
    <a href="talk.php" class="back">＜</a>
    <div class="container">
      <div class="title"><?= $_SESSION['friendName'] ?></div>
    </div>
  </header>
  <div class="container">
    <?php foreach ($app->getTalk()->talk as $talk) : ?>
      <?php if ($_SESSION['me']->id === $talk->user_id) : ?>
        <li>
          <div class="color">
            <?= h($talk->text) ?>
          </div>
          <div class="time">
            <?= h($talk->time) ?>
          </div>
        </li>
        <?php continue; ?>
      <?php endif; ?>
      <li>
        <div class="talk">
          <?= h($talk->text) ?>
        </div>
        <div class="time">
          <?= h($talk->time) ?>
        </div>
      </li>
    <?php endforeach ?>
  </div>
  <footer>
    <form action="" method="post" class="form">
      <textarea name="text" class="text" ></textarea>
      <input type="submit" value="送信" class="btn">
    </form>
  </footer>
</body>
</html>
