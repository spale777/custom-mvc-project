<?php
class Reg extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->view->render('reg/index');
    }
    public function run()
    {
        $input = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];

        // Controller klasa poseduje metodu checkInput
        // vraca string ukoliko je pravilno ukucano ili bool false ukoliko nije
        $input = $this->checkInput($input);

        $username = $input['username'];
        $password = $input['password'];

        if ($username && $password) {
            $this->model->username = $username;
            $this->model->password = $password;
            $this->model->run();
        } else {
            header('Location:' . URI . '/reg?err=1');
            exit;
        }
    }
}