<?php

namespace Moonphp\Moonphp\Exception;

use Exception;

class DuplicateEmailException extends Exception
{
    public function __construct($message = "Email sudah digunakan", $code = 23000)
    {
        parent::__construct($message, $code);
    }
}
