<?php

namespace App\Models;

class Task
{
    private \PDO $pdo;

    public function __construct(\PDO $PDO)
    {
        $this->pdo = $PDO;
    }

    public function all(int $offset, ?string $sort, bool $desc): array
    {
        $query = 'SELECT id, name, email, text, status, edited FROM tasks';
        if ($sort !== null) {
            $query .= sprintf(' ORDER BY %s %s', $sort, $desc ? 'DESC' : '');
        }
        $query .= ' LIMIT ?,3';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            $offset,
        ]);

        return $stmt->fetchAll();
    }

    public function allCount()
    {
        return $this->pdo->query('SELECT COUNT(id) FROM tasks')->fetchColumn();
    }

    public function add(string $name, string $email, string $text): bool
    {
        $query = 'INSERT INTO tasks (name, email, text) VALUES (?, ?, ?)';
        return $this->pdo->prepare($query)->execute([$name, $email, $text]);
    }

    public function update(int $id, string $text): bool
    {
        $query = 'UPDATE tasks SET text = ?, edited = 1 WHERE id = ?';
        return $this->pdo->prepare($query)->execute([$text, $id]);
    }

    public function done(int $id): bool
    {
        $query = 'UPDATE tasks SET status = 1 WHERE id = ?';
        return $this->pdo->prepare($query)->execute([$id]);
    }

    /**
     * @return \stdClass|false
     */
    public function get(int $id)
    {
        $query = 'SELECT id, name, email, text FROM tasks WHERE id = ?';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}