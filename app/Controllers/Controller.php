<?php

namespace App\Controllers;

abstract class Controller
{
    protected function isAuthorized(): bool
    {
        return $_SESSION['authorized'] ?? false;
    }
}
