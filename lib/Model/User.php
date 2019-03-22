<?php

namespace MyApp\Model;

class User extends \MyApp\Model {
  public function create($values) {
    $stmt = $this->db->prepare("insert into user (name, email, password) values (:name, :email, :password)");
    $res = $stmt->execute([
      ':name' => $values['name'],
      ':email' => $values['email'],
      ':password' => password_hash($values['password'], PASSWORD_DEFAULT)
    ]);

    if ($res === false) {
      throw new \MyApp\Exception\DuplicateEmail();
    }
  }

  public function login($values) {
    $stmt = $this->db->prepare("select * from user where email = :email");
    $stmt->execute([
      ':email' => $values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    $user = $stmt->fetch();

    if (empty($user)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'], $user->password)) {
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    return $user;
  }

  public function findFriend($friend) {
    $stmt = $this->db->prepare("select * from friend where user_id = :user_id");
    $stmt->execute([
      ':user_id' => $friend['user_id']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }

  public function showList($userList) {
    $stmt = $this->db->prepare("select * from user where not (name = :name)");
    $stmt->execute([
      ':name' => $userList['name']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }

  public function addUser($selectedUser) {
    $stmt = $this->db->prepare("insert into friend (user_id, selected_id, name) values (:user_id, :selected_id, :name)");
    $stmt->bindValue(':user_id', $selectedUser['user_id']);
    $stmt->bindValue(':selected_id', $selectedUser['selected_id']);
    $stmt->bindValue(':name', $selectedUser['name']);

    $stmt->execute();
  }

  public function deleteUser($deleteUser) {
    $stmt = $this->db->prepare("delete from friend where id = :id");
    $stmt->execute([
      ':id' => $deleteUser['friendId']
    ]);
  }

  public function insertTalk($talk) {
    $stmt = $this->db->prepare("insert into talk (user_id, friend_id, text, time)
      values (:user_id, :friend_id, :text, :time)");
    $stmt->execute([
      ':user_id' => $talk['user_id'],
      ':friend_id' => $talk['friend_id'],
      ':text' => $talk['text'],
      ':time' => $talk['time']
    ]);
  }

  public function selectTalk($talk) {
    $stmt = $this->db->prepare("select * from talk where (user_id = :user_id or friend_id = :user_id) and
      (friend_id = :friend_id or user_id = :friend_id)");
    $stmt->execute([
      ':user_id' => $talk['userId'],
      ':friend_id' => $talk['friendId']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }

  public function post($post) {
    $stmt = $this->db->prepare("insert into post (user_name, text) values (:user_name, :text)");
    $stmt->execute([
      ':user_name' => $post['user_name'],
      ':text' => $post['text']
    ]);
  }

  public function selectPost() {
    $stmt = $this->db->prepare("select * from post");
    $stmt->execute();
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }


}
