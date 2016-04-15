<?php

class Dashboard extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $logged = Session::get('logged');
        if (!$logged) {
            header('Location:' . URI . '/login');
            exit;
        }
        Session::renew();
    }

    public function renderAddon ($page, $type)
    {
        if ($type == 'owner') {
            $this->view->render($page, 'dashboard/owner');
        } else if ($type == 'admin') {
            $this->view->render($page, 'dashboard/admin');
        } else {
            $this->view->render($page, 'dashboard/user');
        }
    }

    public function index()
    {
        $this->renderAddon('dashboard/index', Session::get('type'));
    }
    public function addArticle()
    {
        if (Session::get('type') != 'owner') {
            header('Location:' . URI . '/dashboard?err=1');
            exit;
        }
        $this->view->render('dashboard/addArticle', 'dashboard/owner');
    }

    public function addArticleRun()
    {
        if (Session::get('type') != 'owner') {
            header('Location:' . URI . '/dashboard?err=1');
            exit;
        }

        if (
            !isset($_POST['title']) ||
            !isset($_POST['alt_content']) ||
            !isset($_POST['main_content']) ||
            !isset($_POST['section']) ||
            !isset($_FILES['main_pic']) ||
            !isset($_FILES['alt_pic'])
        ) {
            header('Location:' . URI . '/dashboard/addArticle?err=1');
            exit;
        } else {
            $title = $_POST['title'];
            $alt_content = $_POST['alt_content'];
            $main_content = $_POST['main_content'];
            $section =
                $_POST['section'] == 'IT' ||
                $_POST['section'] == 'Sport' ||
                $_POST['section'] == 'Various' ? $_POST['section'] : false;

            $main_pic =
                $_FILES['main_pic']['error'] == UPLOAD_ERR_OK &&
                $_FILES['main_pic']['type'] == 'image/jpeg' ||
                $_FILES['main_pic']['type'] == 'image/png' ||
                $_FILES['main_pic']['type'] == 'image/gif' ? $_FILES['main_pic'] : false;

            $alt_pic =
                $_FILES['alt_pic']['error'] == UPLOAD_ERR_OK &&
                $_FILES['alt_pic']['type'] == 'image/jpeg' ||
                $_FILES['alt_pic']['type'] == 'image/png' ||
                $_FILES['alt_pic']['type'] == 'image/gif' ? $_FILES['alt_pic'] : false;


            if ($alt_pic && $main_pic && $section) {
                $input = [
                    'title' => $title,
                    'alt_content' => $alt_content,
                    'main_content' => $main_content,
                    'section' => $section
                ];
                foreach ($input as $key => $value) {
                    $value = preg_replace('/<\/?script>/', '', $value);
                    $this->model->$key = $value;
                };

                $this->model->addArticleRun();

                $alt_pic['name'] = 'alt_pic.jpeg';
                $main_pic['name'] = 'main_pic.jpeg';

                $dir = ROOT . '/public/images/' . $this->model->id . '/';

                mkdir($dir);

                move_uploaded_file($alt_pic['tmp_name'], $dir . $alt_pic['name']);
                move_uploaded_file($main_pic['tmp_name'], $dir . $main_pic['name']);

                header('Location:' . URI . '/dashboard/addArticle?err=no_error');
            } else {
                header('Location:' . URI . '/dashboard/addArticle?err=2');
            }
        }
    }

    public function editArticles()
    {
        if (Session::get('type') != 'owner') {
            header('Location:' . URI . '/dashboard?err=1');
            exit;
        }

        $this->view->data = $this->model->editArticlesGetNews();
        $this->view->render('dashboard/editArticles', 'dashboard/owner');
    }

    public function editArticle($id = false) {

        if (Session::get('type') != 'owner') {
            header('Location:' . URI . '/dashboard?err=1');
            exit;
        }
        if ($id) {
            $this->view->data = $this->model->getNewsByID($id);
            $this->view->render('dashboard/editArticle', 'dashboard/owner');
        } else {
            header('Location:' . URI . '/dashboard/editArticles');
        }
    }
    public function editArticleRun($id = false)
    {
        if (Session::get('type') != 'owner') {
            header('Location:' . URI . '/dashboard?err=1');
            exit;
        }
        if ($id) {

            if (
                !isset($_POST['title']) ||
                !isset($_POST['alt_content']) ||
                !isset($_POST['section']) ||
                !isset($_POST['main_content'])
            ) {
                header('Location:' . URI . '/dashboard/editArticle/'. $id . '?err=1');
                exit;
            } else {
                $section =
                    $_POST['section'] == 'IT' ||
                    $_POST['section'] == 'Sport' ||
                    $_POST['section'] == 'Various' ? $_POST['section'] : false;

                if ($section) {
                    $input = [
                        'title' => $_POST['title'],
                        'alt_content' => $_POST['alt_content'],
                        'main_content' => $_POST['main_content'],
                        'section' => $section
                    ];
                    foreach ($input as $key => $value) {
                        $value = preg_replace('/<\/?script>/', '', $value);
                        $this->model->$key = $value;
                    };

                    $this->model->editArticle($id);

                } else {
                    header('Location:' . URI . '/dashboard/editArticle/'. $id . '?err=1');
                    exit;
                }
            }
        } else {
            header('Location:' . URI . '/dashboard/editArticles?err=2');
            exit;
        }
    }

    public function deleteArticle($article_id)
    {
        if (Session::get('type') == 'owner') {

            if ($article_id == null) {
                header('Location:' . URI . '/dashboard/editArticles?err=2');
                exit;
            }

            if (is_array($article_id)) {
                header('Location:' . URI . '/dashboard/editArticles?err=3');
                exit;
            }

            $result = $this->model->deleteArticle($article_id);

            if ($result) {
                $dir = ROOT . '/public/images/' . $article_id . '/';

                if (file_exists($dir . 'alt_pic.jpeg') && file_exists($dir . 'main_pic.jpeg')) {
                    unlink ($dir . 'alt_pic.jpeg');
                    unlink ($dir . 'main_pic.jpeg');
                    rmdir($dir);
                }

                header('Location:' . URI . '/dashboard/editArticles?err=no_error');
                exit;


            } else {
                header('Location:' . URI . '/dashboard/editArticles?err=1');
                exit;
            }

        } else {
            header('Location:' . URI . '/dashboard');
            exit;
        }
    }

    public function deleteComment($target)
    {
        if (count($target) < 3) {
            header('Location:' . URI . '/error/deleteCommentError/3');
            exit;
        }

        $ref = $_SERVER['HTTP_REFERER'];
        $arr = explode('?', $ref);
        $ref = $arr[0];
        $section = $target[0];
        $news_id = $target[1];
        $comment_id = $target[2];

        $result = $this->model->getCommentById($comment_id);

        if ($result == 'error') {
            if (empty($ref)){
                header('Location:' . URI . '/dashboard/showComments?err=1');
                exit;
            } else {
                header('Location:' . $ref . '?err=1');
            }
        } else if ($result == null){
            header('Location:' . URI . '/error/deleteCommentError/3');
            exit;
        } else {
            if (
                $result['username'] == Session::get('username') ||
                Session::get('type') == 'owner' ||
                Session::get('type') == 'admin' &&
                $result['news_id'] == $news_id &&
                $result['news_section'] == $section
            ){
                 $result = $this->model->deleteComment($comment_id);

                if($result) {
                    if (empty($ref)) {
                        header('Location:' . URI . '/dashboard/showComments?err=no_error');
                        exit;
                    } else {
                        header('Location:' . $ref . '?err=no_error_comment_deleted');
                        exit;
                    }
                } else {
                    header('Location:' . URI . '/error/deleteCommentError/4');
                    exit;
                }
            } else {
                header('Location:' . URI . '/error/deleteCommentError/2');
                exit;
            }
        }

    }

    public function showComments()
    {
            $user_id = Session::get('id');
            $this->view->data = $this->model->getCommentsByUser($user_id);
            $this->renderAddon('dashboard/showComments', Session::get('type'));
    }

    public function editComment($comment_id)
    {
            $comment_id = isset($comment_id) ? $comment_id : false;

            if (!$comment_id) {
                header('Location:' . URI . '/dashboard/showComments?err=2');
                exit;
            }
            $result = $this->model->getCommentById($comment_id);

            if($result == 'error') {
                header('Location:' . URI . '/error/editCommentError/3');
                exit;
            } else if ($result == null) {
                header('Location:' . URI . '/error/editCommentError/2');
                exit;
            } else {
                if (Session::get('type') == 'owner' || Session::get('type') == 'admin') {
                    if ($result['username'] == Session::get('username')) {
                        $this->view->data = $result;
                    } else {
                        header('Location:' . URI . '/error/editCommentError/1');
                        exit;
                    }
                } else {
                    header('Location:' . URI . '/error/editCommentError/4');
                    exit;
                }
            }
            $this->renderAddon('dashboard/editComment', Session::get('type'));
    }

    public function editCommentRun($comment_id)
    {
        $comment_id = isset($comment_id) ? $comment_id : false;

        if (!$comment_id) {
            header('Location:' . URI . '/dashboard/showComments?err=2');
            exit;
        }

        $result = $this->model->getCommentById($comment_id);

        if($result == 'error') {
            header('Location:' . URI . '/error/editCommentError/3');
            exit;
        } else if ($result == null) {
            header('Location:' . URI . '/error/editCommentError/2');
            exit;
        } else {

            $content = isset($_POST['content']) ? $_POST['content'] : false;

            if(!$content){
                $content = htmlspecialchars($content);
            } else {
                header('Location:' . URI . '/dashboard/editComment/' . $comment_id . '?err=3');
            }

            if (Session::get('type') == 'owner' || Session::get('type') == 'admin'){

                if ($result['username'] == Session::get('username')){

                    $result = $this->model->editComment($comment_id, $content);

                    if($result) {
                        header('Location:' . URI . '/dashboard/editComment/' . $comment_id . '?err=no_error');
                        exit;
                    } else {
                        header('Location:' . URI . '/dashboard/editComment/' . $comment_id . '?err=4');
                        exit;
                    }
                } else {
                    header('Location:' . URI . '/error/editCommentError/1');
                    exit;
                }
            } else {
                header('Location:' . URI . '/error/editCommentError/4');
                exit;
            }
        }
    }

    public function showCommentsAll()
    {
        if(Session::get('type') == 'owner' || Session::get('type') == 'admin'){
            $this->view->data = $this->model->getAllComments();
            $this->renderAddon('dashboard/showCommentsAll', Session::get('type'));
        } else {
            header('Location:' . URI . '/dashboard');
            exit;
        }
    }

    public function showUserComments($user_id)
    {
        if (Session::get('type') == 'owner' || Session::get('type') == 'admin'){

            $user_id = isset($user_id) && !empty($user_id) ? $user_id : false;

            if($user_id){
                $result = $this->model->getUserById($user_id);

                if ($result == 'error') {
                    header('Location:' . URI . '/error/userCommentError/1');
                    exit;
                } else if (empty($result)){
                    header('Location:' . URI . '/error/userCommentError/1');
                    exit;
                } else {
                    if(Session::get('username') == $result['username']){
                        header('Location:' . URI . '/dashboard/showComments');
                        exit;
                    }
                    $this->view->data = $this->model->getCommentsByUser($user_id);
                    $this->renderAddon('dashboard/showUserComments', Session::get('type'));
                }
            } else {
                header('Location:' . URI . '/dashboard/showCommentsAll?err=3');
            }

        } else {
            header('Location:' . URI . '/dashboard');
            exit;
        }
    }

    public function logout()
    {
        Session::unsetKeys();
        Session::destroy();
        header('Location: ' . URI . '');
        exit;
    }
}