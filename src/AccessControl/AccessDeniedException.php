<?php

namespace App\AccessControl;

use Exception;

class AccessDeniedException extends Exception
{
    public function __construct(){
        $this->message = 'Access Denied';
    }
}
?>