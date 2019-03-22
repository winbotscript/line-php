<?php

namespace MyApp\Controller;

class UserList extends \MyApp\Controller {
  public function run() {
    if (!$this->isLoggedIn()) {
      header('Location: ' . SITE_URL);
    }

    $this->showUsers();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->postProcess();
    }
  }

  protected function showUsers() {
        $userModel = new \MyApp\Model\User();
        $this->setUserList('userList', $userModel->showList([
          'name' => $_SESSION['me']->name
        ]));

        $this->setSelectedUser('friend', $userModel->findFriend([
          'user_id' => $_SESSION['me']->id
        ]));
  }

  protected function postProcess() {
        // if ($this->getSelectedUser()->friend->id === $this->getUserList()->userList->id) { return; }

        $userModel = new \MyApp\Model\User();
        $userModel->addUser([
          'selected_id' => $_POST['selected_id'],
          'user_id' => $_SESSION['me']->id,
          'name' => $_POST['selectedUser']
        ]);

        header('Location: ' . SITE_URL . '/friend.php');
        exit();
  }

}
