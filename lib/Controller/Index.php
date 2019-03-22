<?php

namespace MyApp\Controller;

class Index extends \MyApp\Controller {

  public function run() {
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
      exit();
    }

    $userModel = new \MyApp\Model\User();
    $this->setTimeLine('timeLine', $userModel->selectPost());

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $userModel = new \MyApp\Model\User();
      $userModel->post([
        'user_name' => $_SESSION['me']->name,
        'text' => $_POST['text']
      ]);
    }

    if (isset($_POST['text'])) {
      header('Location: ' . SITE_URL . '/timeline.php');
    }




  }

}
