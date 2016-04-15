<?php
class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    public function index()
    {
        $logged = Session::get('logged');
        if ($logged) {
            header('Location:' . URI . '/dashboard');
            exit;
        } else {
            $this->view->render('login/index');
        }

    }
    public function run()
    {
        $input = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        $input = $this->checkInput($input);

        if ($input) {
            $username = $input['username'];
            $password = $input['password'];
            print_r($password);
        } else {
            header('Location:' . URI . '/login?err=1');
            exit;
        }

        $this->model->username = $username;
        $this->model->password = $password;

        $this->model->run();

    }
}