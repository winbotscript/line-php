<?php
require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Index();

$app->run();
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>line</title>
  <link rel="stylesheet" href="css/friend.css">
</head>
<body>
  <header>
    <div class="timeline">タイムライン</div>
  </header>

  <div class="timelinebox">

    <?php foreach ($app->getTimeLine()->timeLine as $timeLine) : ?>
      <div class="postcontainer">
        <?php if ($_SESSION['me']->name === $timeLine->user_name) : ?>
          <div class="postUser">
              <?= h($timeLine->user_name); ?>
          </div>
          <div class="color">
            <?= h($timeLine->text); ?>
          </div>
          <?php continue; ?>
        <?php endif; ?>

        <div class="postUser">
          <?= h($timeLine->user_name); ?>
        </div>
        <div class="postText">
          <?= h($timeLine->text); ?>
        </div>
      </div>
    <?php endforeach ?>
    </div>

    <form action="" method="post" class="form">
      <textarea name="text" class="text" ></textarea>
      <input type="submit" value="送信" class="btn">
    </form>


  <footer>
    <div class="container">
      <a href="friend.php" class="friend">友達</a>
      <a href="talk.php" class="talk">トーク</a>
      <a href="#" class="timeline">タイムライン</a>
      <div class="clear"></div>
    </div>
  </footer>
</body>
</html>
