<?php

require_once './models/IndexModel.php';

class AdminController extends Controller
{
    private $pageTpl = '/views/admin.tpl.php';

    public function __construct()
    {
        $this->model = new AdminModel();
        $this->view = new View();
    }

    public function index() {
        if (!$_SESSION['user'])
            header('Location: /testTask/login/');
        $tasks = new IndexModel();
        $this->pageData['tasks'] = $tasks->getTasks();
        $this->pageData['title'] = "Админ панель";
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function tasks() {
        $tasks = new IndexModel();
        $tasks = $tasks->getTasks();
        echo json_encode($tasks);
    }

}