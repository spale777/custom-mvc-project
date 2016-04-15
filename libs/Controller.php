<?php

class Controller
{
    function __construct()
    {
        $this->view = new View();
        Session::init();
    }
    public function loadModel($model)
    {
        $file = 'models/' . $model . '_Model.php';

        if(file_exists($file)){
            require $file;
            $model = $model . '_Model';
            $this->model = new $model();
        }
    }
    public function checkInput($input)
    {
        $username = isset($input['username']) &&
        preg_match('/^[a-zA-Z][a-zA-Z0-9]*_?[a-zA-Z0-9]*$/', $input['username']) &&
        strlen($input['username']) <= 25 ? $input['username'] : false;

        //Testira sifru ime ukoliko se slaze sa REGEX-om dodeljuje vrednost (sifra moze poceti brojem)
        $password = isset($input['password']) &&
        preg_match('/^[a-zA-Z0-9]*_?[a-zA-Z0-9]*$/', $input['password']) &&
        strlen($input['password']) <= 25 ? $input['password'] : false;

        if ($username && $password) {
            $input = [
                'username' => $username,
                'password' => $password
            ];
            return $input;
        } else {
            $input = false;
            return $input;
        }

    }
}