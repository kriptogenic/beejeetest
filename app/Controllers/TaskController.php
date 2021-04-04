<?php

namespace App\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
    public function index(Task $task)
    {
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * 3 ;

        $sort = $_GET['sort'] ?? null;
        if (!in_array($sort, ['name', 'email', 'status'])) {
            $sort = null;
        }

        $order = $_GET['order'] ?? null;
        $desc = $order === 'desc';

        $tasks = $task->all($offset, $sort, $desc);
        $count = $task->allCount();

        view('tasks_all', [
            'tasks' => $tasks,
            'pages' => ceil($count / 3),
            'current' => $page,
            'sort' => $sort,
            'order' => $order,
            'authorized' => $this->isAuthorized(),
        ]);
    }

    public function create()
    {
        view('tasks_add', [
            'error' => get_error(),
            'authorized' => $this->isAuthorized(),
        ]);
    }

    public function store(Task $task)
    {
        $error = $this->validate($_POST);
        if ($error !== false) {
            redirect(base_url('add'), $error);
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $text = $_POST['text'];

        $task->add($name, $email, $text);

        redirect(base_url(''));
    }

    public function done(Task $task)
    {
        if ($this->isAuthorized() === false) {
            $this->redirectToLoginPage();
            return;
        }

        $task_id = intval($_GET['task'] ?? 0);
        if ($task_id !== 0) {
            $task->done($task_id);
        }

        redirect(base_url(''));
    }

    public function edit(Task $taskModel)
    {
        if ($this->isAuthorized() === false) {
            $this->redirectToLoginPage();
            return;
        }

        $task_id = intval($_GET['task'] ?? 0);

        $task = $taskModel->get($task_id);

        if ($task === false) {
            view('404');
            return;
        }

        view('tasks-edit', [
            'task' => $task,
            'authorized' => $this->isAuthorized(),
        ]);
    }

    public function update(Task $task)
    {
        if ($this->isAuthorized() === false) {
            $this->redirectToLoginPage();
            return;
        }

        $error = $this->validate($_POST);
        if ($error !== false) {
            redirect(base_url('add'), $error);
        }

        $name = $_POST['name'];
        $email = $_POST['email'];
        $text = $_POST['text'];
        $id = $_POST['id'];

        $task->update($id, $name, $email, $text);

        redirect(base_url(''));
    }

    private function redirectToLoginPage()
    {
        redirect(base_url('login'), 'У вас нет прав');
    }

    private function validate(array $data)
    {
        if (empty($data['name'])) {
            return 'Имя обязательное поля';
        }

        if (empty($data['email'])) {
            return 'Email обязательное поля';
        }

        if (empty($data['text'])) {
            return 'Текст обязательное поля';
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return 'Неверный email';
        }

        return false;
    }
}
