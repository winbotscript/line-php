<?php

namespace MyApp\Controller;

class Delete extends \MyApp\Controller {
  public function run() {
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    } else {
      header('Location: ' . SITE_URL);
    }
  }

  protected function postProcess() {
    $userModel = new \MyApp\Model\User();

    $userModel->deleteUser([
      'friendId' => $_POST['friendId']
    ]);

    header('Location: ' . SITE_URL . '/friend.php');
  }

}
