<?php

namespace App\Controllers;

class AuthController extends Controller
{
    public function show()
    {
        if ($this->isAuthorized()) {
            redirect(base_url(''));
            return;
        }

        view('login', [
            'error' => get_error()
        ]);
    }

    public function login(array $admin_credentials)
    {
        if (empty($_POST['login'])) {
            redirect(base_url('login'), 'Имя обязательное поля');
            return;
        }

        if (empty($_POST['password'])) {
            redirect(base_url('login'), 'Пароль обязательное поля');
            return;
        }

        if ($admin_credentials['login'] !== $_POST['login']
            || $admin_credentials['password'] !== $_POST['password']) {
            redirect(base_url('login'), 'Данные не верны');
            return;
        }

        $_SESSION['authorized'] = true;
        redirect(base_url(''));
    }

    public function logout()
    {
        unset($_SESSION['authorized']);
        redirect(base_url(''));
    }
}
