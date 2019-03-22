<?php
require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Signup();

$app->run();

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>line</title>
  <link rel="stylesheet" href="css/indexstyle.css">
</head>
<body>
    <h1>新規登録</h1>
    <div class="container">
      <div class="form">
        <form name="signup" method="post" action="">
          <p>ユーザー名</p>
          <input type="text" name="name" value="<?=
            isset($app->getNameValues()->name) ? h($app->getNameValues()->name) : ''; ?>">
          <p class="err"><?= h($app->getErrors('name')); ?></p>
          <p>メールアドレス</p>
          <input type="text" name="email" value="<?=
            isset($app->getEmailValues()->email) ? h($app->getEmailValues()->email) : ''; ?>">
          <p class="err"><?= h($app->getErrors('email')); ?></p>
          <p>パスワード</p>
          <input type="text" name="password">
          <p class="err"><?= h($app->getErrors('password')); ?></p>
          <input type="submit" value="新規登録">
          <input type="hidden" name='token' value="<?= h($_SESSION['token']); ?>">
        </form>
      </div>
    </div>
</body>
</html>
