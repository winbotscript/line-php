<?php

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Login();

$app->run();
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>line</title>
  <link rel="stylesheet" href="css/indexstyle.css">
</head>
<body>
    <h1>ログイン</h1>
    <div class="container">
      <div class="form">
        <form name="login" method="post" action="">
          <p>メールアドレス</p>
          <input type="text" name="email" value="<?=
            isset($app->getEmailValues()->email) ? h($app->getEmailValues()->email) : ''; ?>">
          <p class="err"><?= h($app->getErrors('login')); ?></p>
          <p>パスワード</p>
          <input type="text" name="password">
          <input type="submit" value="ログイン">
          <input type="hidden" name='token' value="<?= h($_SESSION['token']); ?>">
        </form>
      </div>
    </div>
</body>
</html>
