<?php

namespace MyApp\Exception;

class InvalidPassword extends \Exception {
  protected $message = 'パスワードを入力してください';
}
