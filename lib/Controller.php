<?php

namespace MyApp;

class Controller {

  private $errors;
  private $nameValues;
  private $emailValues;
  private $userList;
  private $selectedUser;
  private $talk;
  private $timeLine;

  public function __construct() {
    if (!isset($_SESSION['token'])) {
      $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
    }

    $this->errors = new \stdClass();
    $this->nameValues = new \stdClass();
    $this->emailValues = new \stdClass();
    $this->userList = new \stdClass();
    $this->selectedUser = new \stdClass();
    $this->talk = new \stdClass();
    $this->timeLine = new \stdClass();
  }

  // タイムライン
  protected function setTimeLine($key, $timeLine) {
    $this->timeLine->$key = $timeLine;
  }

  public function getTimeLine() {
    return $this->timeLine;
  }


  // トークの内容
  protected function setTalk($key, $talk) {
    $this->talk->$key = $talk;
  }

  public function getTalk() {
    return $this->talk;
  }

  // 友達追加されたユーザー
  protected function setSelectedUser($key, $selectedUser) {
    $this->selectedUser->$key = $selectedUser;
  }

  public function getSelectedUser() {
    return $this->selectedUser;
  }

  // 自分以外ユーザー一覧
  protected function setUserList($key, $userList) {
    $this->userList->$key = $userList;
  }

  public function getUserList() {
    return $this->userList;
  }

  // フォーム名前値保持
  protected function setNameValues($key, $nameValues) {
    $this->nameValues->$key = $nameValues;
  }

  public function getNameValues() {
    return $this->nameValues;
  }

  // フォームemail値保持
  protected function setEmailValues($key, $emailValues) {
    $this->emailValues->$key = $emailValues;
  }

  public function getEmailValues() {
    return $this->emailValues;
  }

  // error syori
  protected function setErrors($key, $error) {
    $this->errors->$key = $error;
  }

  public function getErrors($key) {
    return isset($this->errors->$key) ? $this->errors->$key : '';
  }

  protected function hasError() {
    return !empty(get_object_vars($this->errors));
  }

  protected function isLoggedIn() {
    return isset($_SESSION['me']) && !empty($_SESSION['me']);
  }

  public function me() {
    return $this->isLoggedIn() ? $_SESSION['me'] : null;
  }




}
