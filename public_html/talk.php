<?php
require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Friend();

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
    <h1 class="white">トーク</h1>
    <input type="text"placeholder="検索">
  </header>

  <?php if (count($app->getSelectedUser()->friend) === 0) : ?>
    <div class="nofriend">友達追加してください</div>
  <?php endif; ?>


  <div class="friends">
    <?php foreach($app->getSelectedUser()->friend as $friend) : ?>
      <h1>
        <div>
          <img src="img/mogwai.png" class="mog" alt="mogwai">
          <span class="name"><?= h($friend->name) ?></span>
          <form action="talkParticular.php" method="post" class="talkform">
            <input type="hidden" name="friendId" value="<?= $friend->selected_id ?>">
            <input type="hidden" name="friendName" value="<?= $friend->name ?>">
            <input type="submit" class="talkParticular" value="トーク">
          </form>
          <form action="delete.php" method="post" class="deleteform">
            <input type="hidden" name="friendId" value="<?= $friend->id ?>">
            <input type="submit" class="delete" value="削除">
          </form>
        </div>
      </h1>

    <?php endforeach; ?>
  </div>


  <footer>
    <div class="container">
      <a href="friend.php" class="friend">友達</a>
      <a href="#" class="talk">トーク</a>
      <a href="timeline.php" class="timeline">タイムライン</a>
      <div class="clear"></div>
    </div>
  </footer>
</body>
</html>
