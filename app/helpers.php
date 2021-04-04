<?php


function base_url(string $path): string
{
    return BASE_URI .'/'. $path;
}

function view(string $file, array $params = [])
{
    extract($params);
    include APP_DIR . 'Views/' . $file . '.php';
}

function redirect(string $url, string $error = null)
{
    if ($error !== null) {
        $_SESSION['error'] = $error;
    }
    header('Location: '. $url);
}

function get_error()
{
    if (!array_key_exists('error', $_SESSION))
        return null;
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
    return $error;
}

