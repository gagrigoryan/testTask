<?php


class LoginController extends Controller
{
    private $pageTpl = '/views/login.tpl.php';

    public function __construct()
    {
        $this->model = new LoginModel();
        $this->view = new View();
    }

    public function index() {
        if (!empty($_SESSION))
            header('Location: /testTask/admin');
        $this->pageData['title'] = "Авторизация";
        $this->view->render($this->pageTpl, $this->pageData);
    }

    public function auth() {
        $this->pageData['title'] = "Авторизация";
        $data = $_POST;
        print_r($this->model->checkAdmin($data));
        if ($this->model->checkAdmin($data)){
            header('Location: /testTask/admin');
        }
        else {

            header('Location: /testTask/login/index/?mess=error');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /testTask/');
    }
}