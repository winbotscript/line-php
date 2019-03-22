<?php

namespace MyApp\Exception;

class DuplicateEmail extends \Exception {
  protected $message = '追加できませんでした';
}
