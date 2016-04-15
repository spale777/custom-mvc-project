<?php
class News extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->data = $this->model->getNewsAll();
        $this->view->render('news/index');
    }

    public function sport($id = false)
    {
        if ($id){
            $this->view->comments = $this->model->getComments($id);
            $this->view->data = $this->model->getNewsById($id);
            $this->view->render('news/article');
        } else {
            $this->view->data = $this->model->getNewsBySection('sport');
            $this->view->render('news/index');
        }
    }

    public function it($id = false)
    {
        if ($id){
            $this->view->comments = $this->model->getComments($id);
            $this->view->data = $this->model->getNewsById($id);
            $this->view->render('news/article');
        } else {
            $this->view->data = $this->model->getNewsBySection('it');
            $this->view->render('news/index');
        }

    }

    public function various($id = false)
    {
        if ($id){
            $this->view->comments = $this->model->getComments($id);
            $this->view->data = $this->model->getNewsById($id);
            $this->view->render('news/article');
        } else {
            $this->view->data = $this->model->getNewsBySection('various');
            $this->view->render('news/index');
        }
    }

    public function postComment($target)
    {
        if(Session::get('logged')) {

            $requested_article = $this->model->getNewsById($target[2])[0];

            $section =
                isset($target[0]) &&
                $target[0] == $requested_article['section'] ? $target[0] : false;

            $user_id =
                isset($target[1]) &&
                $target['1'] == Session::get('id') ? $target[1] : false;
            $article_id =
                isset($target[2]) &&
                !empty($requested_article) ? $target[2] : false;

            $comment = isset($_POST['comment']) && strlen(trim($_POST['comment'])) > 5 ? $_POST['comment'] : false;

            if ($section) {
                $this->model->section = $section;
            } else {
                header('Location:' . URI . '/error/commentError/3');
                exit;
            }

            if ($comment) {
                $this->model->comment = htmlspecialchars($comment);
            } else {
                header('Location:' . URI . '/error/commentError/4');
                exit;
            }

            if ($user_id) {
                $this->model->user_id = $user_id;
            } else {
                header('Location:' . URI . '/error/commentError/2');
                exit;
            }

            if ($article_id) {
                $this->model->article_id = $article_id;
            } else {
                header('Location:' . URI . '/error/commentError/3');
                exit;
            }

            $this->model->insertComment();

        } else {
            header('Location:' . URI . '/error/commentError/1');
            exit;
        }
    }
}