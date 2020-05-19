<?php


class TaskController
{
    private $pageTpl = '/views/main.tpl.php';

    public function __construct()
    {
        $this->model = new TaskModel();
        $this->view = new View();
    }

    public function add() {
        echo $this->model->create($_POST);
//        $tasks = $this->model->getTasks();
//        $this->pageData['title'] = "Главная страница";
//        $this->pageData['tasks'] = $tasks;
//        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function update() {
        if (!empty($_SESSION))
            $this->model->update($_POST);
        header('Location: /testTask/admin/');
    }
}