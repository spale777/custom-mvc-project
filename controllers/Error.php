<?php
namespace err;

class Error extends \Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render('error/index');
    }

    public function commentError($err = false)
    {
        if ($err) {
            switch ($err) {
                case $err == '1':
                    $this->view->err = '<h2>Morate Biti Ulogovani da biste ostavili komentar</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '2':
                    $this->view->err = '<h2>Nemate dozvolu da objavite komentar kao drugi korisnik</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '3':
                    $this->view->err = '<h2>Nije moguce postaviti komentar na vest koja ne postoji</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '4':
                    $this->view->err = '<h2>Komentar ne moze biti prazan niti manji od 5 karaktera</h2>';
                    $this->view->render('error/commentError');
                    break;
                default:
                    $this->view->err = '<h2>Doslo je do nepredvidjene greske</h2>';
                    $this->view->render('error/commentError');
                    break;
            }
        }
    }
    public function deleteCommentError($err = false)
    {
        if ($err) {
            switch ($err) {
                case $err == '1':
                    $this->view->err = '<h2>Morate Biti Ulogovani da biste obrisali komentar</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '2':
                    $this->view->err = '<h2>Nemate dozvolu da obrisete ili izmenite komentar drugog korisnika</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '3':
                    $this->view->err = '<h2>Komentar koji pokusavate da obrisete ne postoji</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '4':
                    $this->view->err = '<h2>Doslo je do greske prilikom brisanja komentara iz baze</h2>';
                    $this->view->render('error/commentError');
                    break;
                default:
                    $this->view->err = '<h2>Doslo je do nepredvidjene greske</h2>';
                    $this->view->render('error/commentError');
                    break;
            }
        }
    }

    public function editCommentError($err = false)
    {
        if ($err) {
            switch ($err) {
                case $err == '1':
                    $this->view->err = '<h2>Nemate dozvolu da menjate komentare drugih korisnika samo je brisanje dozvoljeno</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '2':
                    $this->view->err = '<h2>Komentar koji pokusavate da izmenite ne postoji</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '3':
                    $this->view->err = '<h2>Doslo je do greske prilikom citanja komentara iz baze</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '4':
                    $this->view->err = '<h2>Samo je administratoru i vlasniku dozvoljeno da menja svoj komentar</h2>';
                    $this->view->render('error/commentError');
                    break;
                default:
                    $this->view->err = '<h2>Doslo je do nepredvidjene greske</h2>';
                    $this->view->render('error/commentError');
                    break;
            }
        }
    }

    public function userCommentError($err = false)
    {
        if ($err) {
            switch ($err) {
                case $err == '1':
                    $this->view->err = '<h2>Doslo je do greske prilikom citanja podata o korisniku</h2>';
                    $this->view->render('error/commentError');
                    break;
                case $err == '2':
                    $this->view->err = '<h2>Korisnik cije podatke trazite ne postoji</h2>';
                    $this->view->render('error/commentError');
                    break;
                default:
                    $this->view->err = '<h2>Doslo je do nepredvidjene greske</h2>';
                    $this->view->render('error/commentError');
                    break;
            }
        }
    }
}