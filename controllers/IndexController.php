<?php


class IndexController extends Controller
{
    private $pageTpl = '/views/main.tpl.php';

    public function __construct()
    {
        $this->model = new IndexModel();
        $this->view = new View();
    }

    public function index() {
        $tasks = $this->model->getTasks();
        $this->pageData['title'] = "Главная страница";
        $this->pageData['tasks'] = $tasks;
        $this->view->render($this->pageTpl, $this->pageData);
    }

}