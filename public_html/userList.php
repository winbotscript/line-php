<?php

require_once(__DIR__ . '/../config/config.php');

$app = new \MyApp\Controller\UserList();

$app->run();

 ?>
 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>line</title>
   <link rel="stylesheet" href="css/liststyle.css">
 </head>
 <body>
   <a href="friend.php" class="back">＜</a>
   <header>
     <h1>ユーザー一覧</h1>
   </header>
   <div class="container">

       <?php foreach ($app->getUserList()->userList as $user) : ?>
          <div class="user-container">
            <div class="user">
              <?= h($user->name); ?>
            </div>
            <form action="" method="post"class="btncontainer">
              <input type="hidden" name="selected_id" value="<?= $user->id; ?>">
              <input type="hidden" name="selectedUser" value="<?= $user->name; ?>">
              <input class="btn" type="submit" value="追加">
            </form>
          </div>
        <?php endforeach; ?>

   </div>
 </body>
 </html>
