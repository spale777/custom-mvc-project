<?php
class Login_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $username = $this->username;
        $password = md5($this->password);

        $response = $this->getUser($username);

        if (count($response) == 0) {
            Session::unsetKeys();
            Session::destroy();
            header('Location:' . URI . '/login?err=2');
        } else {
            $rpass = $response['password'];
            if ($rpass === $password) {
                Session::set('logged', true);
                Session::set('username', $response['username']);
                Session::set('type', $response['type']);
                Session::set('id', $response['id']);
                header('Location:' . URI . '/dashboard');
                exit;
            } else {
                header('Location:' . URI . '/login?err=3');
                exit;
            }
        }
    }

}