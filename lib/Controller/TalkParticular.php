<?php

namespace MyApp\Controller;

class TalkParticular extends \MyApp\Controller {
  // private $friendId;

  public function run() {
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['friendId'])) {
        $_SESSION['friendId'] = $_POST['friendId'];
        $_SESSION['friendName'] = $_POST['friendName'];
      }
      if (isset($_POST['text'])) {
        $this->postProcess();
        header('Location: ' . SITE_URL . '/talkParticular.php');
      }
    }

    $userModel = new \MyApp\Model\User();
    $this->setTalk('talk', $userModel->selectTalk([
      'userId' => $_SESSION['me']->id,
      'friendId' => $_SESSION['friendId']
    ]));

  }

  // public $timestamp = time() - (59 * 64 * 2);
  // public $time = date("H:i", $timestamp);

  protected function postProcess() {

    $userModel = new \MyApp\Model\User();
    $userModel->insertTalk([
      'user_id' => $_SESSION['me']->id,
      'friend_id' => $_SESSION['friendId'],
      'text' => $_POST['text'],
      'time' => date("H:i:s")
    ]);
  }

}
