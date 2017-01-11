<?php
require 'TodoList.php';

class TodoRepository
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new PDO('mysql:dbname=todos_dev;host=127.0.0.1', 'dbuser', 'dbpass');
    }

    public function getTodoList()
    {
        $query = 'SELECT * FROM todo_items';
        $result = $this->dbConnection->query($query);

        if (!$result) {
            return [];
        }

        $todoList = new TodoList();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $todoList->add($row['title']);
        }

        return $todoList;
    }

    public function getIncompleteTodoList()
    {
        $query = 'SELECT * FROM todo_items WHERE completed = 0';
        $result = $this->dbConnection->query($query);

        if (!$result) {
            return [];
        }

        $todoList = new TodoList();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $todoList->add($row['title']);
        }

        return $todoList;
    }

    public function getCompletedTodoList()
    {
        $query = 'SELECT * FROM todo_items WHERE completed = 1';
        $result = $this->dbConnection->query($query);

        if (!$result) {
            return [];
        }

        $todoList = new TodoList();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $todoList->add($row['title']);
        }

        return $todoList;
    }
}
