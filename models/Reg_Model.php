<?php
class Reg_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $username = $this->username;
        $password = md5($this->password);


        $response = parent::getUser($username);

        /* Ukoliko uneseno korisnicko ime ne postoji unosi ga u bazu
         * dolazi do id-a korisnika prijavljuje ga i salje na kontrolnu tablu
         * u suprotnom obavestava korisnika da je korisnicko ime zauzeto
         */
        if (empty($response)) {

            $id = $this->insertUser($username, $password);

            if ($id){
                $response = parent::getUserByID($id);
                Session::set('logged', true);
                Session::set('username', $response['username']);
                Session::set('type', $response['type']);
                header('Location: /dashboard');
                exit;
            } else {
                header('Location:' . URI . '/reg?err=3');
                exit;
            }
        } else {
            header('Location:' . URI . '/reg?err=2');
            exit;
        }
    }

}