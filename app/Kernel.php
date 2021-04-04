<?php

namespace App;

use App\Controllers\AuthController;
use App\Controllers\TaskController;
use App\Models\Task;

class Kernel
{
    private array $config;

    public function __construct(array $config)
    {

        $this->config = $config;
    }

    public function run()
    {
        session_start();
        $uri = strtolower($_SERVER['REQUEST_URI']);
        $uri = parse_url($uri)['path'];
        if (strpos($uri, BASE_URI) !== 0) {
            $this->show404();
            return;
        }
        $uri = substr($uri, strlen(BASE_URI));

        $this->routing($uri);
    }

    private function getDbConnection(): \PDO
    {
        return new \PDO(
            'mysql:dbname='. $this->config['db']['database'] .';host=localhost',
            $this->config['db']['user'],
            $this->config['db']['password'],
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }

    private function getTaskModel(): Task
    {
        $pdo = $this->getDbConnection();
        return new Task($pdo);
    }

    private function routing(string $uri)
    {

        switch ($uri) {
            case '/':
                (new TaskController)->index($this->getTaskModel());
                break;
            case '/add':
                (new TaskController)->create();
                break;
            case '/store':
                (new TaskController)->store($this->getTaskModel());
                break;
            case '/login':
                (new AuthController)->show();
                break;
            case '/login-post':
                (new AuthController)->login($this->config['credentials']);
                break;
            case '/logout':
                (new AuthController)->logout();
                break;
            case '/done':
                (new TaskController)->done($this->getTaskModel());
                break;
            case '/edit':
                (new TaskController)->edit($this->getTaskModel());
                break;
            case '/update':
                (new TaskController)->update($this->getTaskModel());
                break;
            default:
                $this->show404();
        }
    }

    private function show404()
    {
        view('404');
    }
}
