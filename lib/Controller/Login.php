<?php

namespace MyApp\Controller;

class Login extends \MyApp\Controller {

  public function run() {
    // if ($this->isLoggedIn()) {
    //   header('Location: ' . SITE_URL . '/friend.php');
    //   exit();
    // }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

  protected function postProcess() {
    try {
      $this->validate();
    } catch(\MyApp\Exception\EmptyPost $e) {
      $this->setErrors('login', $e->getMessage());
    }

    // フォーム値のこす
    $this->setEmailValues('email', $_POST['email']);

    if ($this->hasError()) {
      return;
    } else {
      // create user
      try {
        $userModel = new \MyApp\Model\User();
        $user = $userModel->login([
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      } catch(\MyApp\Exception\UnmatchEmailOrPassword $e) {
        $this->setErrors('login', $e->getMessage());
        // echo "データベースと一致しません";
        return;
      }

      // login処理
      session_regenerate_id(true);
      $_SESSION['me'] = $user;


      header('Location: ' . SITE_URL . '/friend.php');
      exit();

    }

  }

  private function validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "invalid token";
      exit();
    }

    if (!isset($_POST['email']) || !isset($_POST['password'])) {
      echo "値を入力してください";
      exit();
    }

    if ($_POST['email'] === '' || $_POST['password'] === '') {
      throw new \MyApp\Exception\EmptyPost();
    }
  }

}
