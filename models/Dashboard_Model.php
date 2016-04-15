<?php

class Dashboard_Model extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function addArticleRun()
    {
        $title = $this->title;
        $alt_content = $this->alt_content;
        $main_content = $this->main_content;
        $section = $this->section;

        $qstring = $this->db->prepare("INSERT INTO news (title, alt_content, main_content, section)
                                       VALUES (:title, :alt_content, :main_content, :section)");
        if ($qstring->execute([
            ':title' => $title,
            ':alt_content' => $alt_content,
            ':main_content' => $main_content,
            ':section' => $section
        ])) {
            $this->id = $this->db->lastInsertId();
        } else {
            header('Location:' . URI . '/dashboard/addArticle?err=3');
        }
    }
    public function getNewsById($id)
    {
        return parent::getNewsById($id);
    }

    public function editArticlesGetNews()
    {
        return $this->getNewsForDashboard();
    }

    public function editArticle($id)
    {
        $qstring = $this->db->prepare(
            "UPDATE news
            set title= :title,
            alt_content= :alt_content,
            main_content= :main_content,
            section= :section
            WHERE id= :id"
        );

        if($qstring->execute([
            ':title' => $this->title,
            ':alt_content' => $this->alt_content,
            ':main_content' => $this->main_content,
            ':section' => $this->section,
            ':id' => $id
        ])) {
            header('Location:' . URI . '/dashboard/editArticle/'. $id . '?err=no_error');
            exit;
        } else {
            header('Location:' . URI . '/dashboard/editArticle/'. $id . '?err=2');
            exit;
        }
    }

    public function deleteArticle($article_id)
    {
        $qstring = $this->db->prepare("DELETE from news WHERE id = :id");

        if ($qstring->execute(
            [
                ':id' => $article_id
            ]
        )){
            return true;
        } else {
            return false;
        }
    }

    public function getCommentByID($comment_id)
    {
        $qstring = $this->db->prepare (
            "SELECT
            users.username,
            comments.content,
            comments.id,
            news.id as news_id,
            news.section as news_section
            FROM comments
            JOIN news ON comments.news_id = news.id
            JOIN users on comments.user_id = users.id
            WHERE comments.id = :comment_id"
        );

        if($qstring->execute(
            [
                ':comment_id' => $comment_id
            ]
        )) {
            $result = $qstring->fetch(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                return $result;
            } else {
                $result = null;
                return $result;
            }
        } else {
            $result = 'error';
            return $result;
        }
    }

    public function getCommentsByUser($user_id)
    {
        $qstring = $this->db->prepare(
            "SELECT
            users.id as user_id,
            users.username,
            comments.id as comment_id,
            comments.content,
            comments.created,
            news.id as news_id,
            news.section as news_section
            FROM comments
            JOIN news ON comments.news_id = news.id
            JOIN users ON comments.user_id = users.id
            WHERE comments.user_id = :user_id
            ORDER BY comments.created DESC"
        );

        if($qstring->execute(
            [
                ':user_id' => $user_id
            ]
        )) {
            $result = $qstring->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)) {
                return $result;
            } else {
                $result = null;
                return $result;
            }

        } else {
            $result = 'error';
            return $result;
        }
    }

    public function deleteComment($comment_id)
    {
        $qstring = $this->db->prepare("DELETE FROM comments WHERE id= :comment_id");

        if ($qstring->execute(
            [
                ':comment_id' => $comment_id
            ]
        )) {
            return true;
        } else {
            return false;
        }
    }

    public function editComment ($comment_id, $content)
    {
        $qstring = $this->db->prepare("UPDATE comments SET content= :content WHERE comments.id= :comment_id");

        if ($qstring->execute(
            [
                ':content' => $content,
                ':comment_id' => $comment_id
            ]
        )){
            return true;
        } else {
            return false;
        }
    }
    public function getAllComments()
    {
        $qstring = $this->db->prepare(
            "SELECT
            users.id as user_id,
            users.username,
            comments.id as comment_id,
            comments.content,
            comments.created,
            news.id as news_id,
            news.section as news_section
            FROM comments
            JOIN news ON comments.news_id = news.id
            JOIN users ON comments.user_id = users.id
            ORDER BY comments.created DESC");

        if ($qstring->execute()){

            $result = $qstring->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($result)){
                return $result;
            } else {
                $result = null;
                return $result;
            }

        } else {
            $result = 'error';
            return $result;
        }
    }

    public function getUserByID($id)
    {
        return parent::getUserByID($id);
    }

}