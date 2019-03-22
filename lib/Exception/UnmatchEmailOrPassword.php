<?php

namespace MyApp\Exception;

class UnmatchEmailOrPassword extends \Exception {
  protected $message = 'メールアドレスまたはパスワードが間違っています';
}
