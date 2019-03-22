<?php
require_once(__DIR__ . '/../config/config.php');
// var_dump($_SESSION['me']);

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
    <form action="logout.php" method="post" id="logout" >
      <input type="submit" value="ログアウト" class="logout">
      <input type="hidden" name='token' value="<?= h($_SESSION['token']); ?>">
    </form>
    <h1 class="white">友達<?= count($app->getSelectedUser()->friend); ?>人</h1>
    <input type="text" placeholder="検索">
    <a href="userList.php" class="userList">友達追加</a>
  </header>

  <div>
    <img class="mogwai" src="img/mogwai.png" alt="mogwai"> <h2 class="userName"><?= h($app->me()->name); ?></h2>
  </div>
  <img src="img/mogwai2.png" alt="mogwai" class="mogwai2">
  <div class="friends-total">
    <h3>友達<?= count($app->getSelectedUser()->friend); ?>人</h3>
  </div>
  <div class="friends">
    <?php if (count($app->getSelectedUser()->friend) === 0) : ?>
      <div class="nofriend">右上から友達追加してください</div>
    <?php endif; ?>

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
          <div class="clear"></div>
        </div>
      </h1>

    <?php endforeach; ?>


  </div>

  <footer>
    <div class="container">
      <a href="#" class="friend">友達</a>
      <a href="talk.php" class="talk">トーク</a>
      <a href="timeline.php" class="timeline">タイムライン</a>
      <div class="clear"></div>
    </div>
  </footer>
</body>
</html>
