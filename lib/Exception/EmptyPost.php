<?php

namespace MyApp\Exception;

class EmptyPost extends \Exception {
  protected $message = '値を入力してください';
}
