<?php

namespace MyApp\Controller;

class Signup extends \MyApp\Controller {

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
    } catch(\MyApp\Exception\InvalidName $e) {
      $this->setErrors('name', $e->getMessage());
    } catch(\MyApp\Exception\InvalidEmail $e) {
      $this->setErrors('email', $e->getMessage());
    } catch(\MyApp\Exception\InvalidPassword $e) {
      $this->setErrors('password', $e->getMessage());
    }

    // フォーム値のこす
    $this->setNameValues('name', $_POST['name']);
    $this->setEmailValues('email', $_POST['email']);

    if ($this->hasError()) {
      return;
    } else {
      // create user
      try {
        $userModel = new \MyApp\Model\User();
        $userModel->create([
          'name' => $_POST['name'],
          'email' => $_POST['email'],
          'password' => $_POST['password']
        ]);
      } catch(\MyApp\Exception\DuplicateEmail $e) {
        $this->setErrors('email', $e->getMessage());
        return;
      }

      header('Location: ' .SITE_URL . '/login.php');
      exit();

    }

  }

  private function validate() {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
      echo "invalid token";
      exit();
    }

    if ($_POST['name'] == '') {
      throw new \MyApp\Exception\InvalidName();
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      throw new \MyApp\Exception\InvalidEmail();
    }

    if (!preg_match('/\A[a-zA-Z0-9]+\z/', $_POST['password'])) {
      throw new \MyApp\Exception\InvalidPassword();
    }
  }

}
