<?php

namespace MyApp\Controller;

class Friend extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit;
    }

    $userModel = new \MyApp\Model\User();
    $this->setSelectedUser('friend', $userModel->findFriend([
      'user_id' => $_SESSION['me']->id
    ]));



  }

}
