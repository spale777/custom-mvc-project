<?php

class News_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getNewsAll()
    {
        return $this->getNews();
    }

    public function getNewsBySection($section)
    {
        return $this->getNews($section);
    }

    public function getNewsById($id)
    {
        return parent::getNewsById($id);
    }

    public function insertComment()
    {
        $qstring = $this->db->prepare (
            "INSERT INTO comments (user_id, news_id, content) VALUES (:user_id, :news_id, :content)"
        );

        if ($qstring->execute([
            ':user_id' => $this->user_id,
            ':news_id' => $this->article_id,
            ':content' => $this->comment
        ])) {
            header ('Location:' . URI . '/news/' . $this->section . '/' . $this->article_id . '?err=no_error');
            exit;
        } else {
            header ('Location:' . URI . '/news/' . $this->section . '/' . $this->article_id . '?err=1');
            exit;
        }
    }

    public function getComments($id)
    {
        $qstring = $this->db->prepare(
            "SELECT
            users.username,
            users.id as user_id,
            comments.content as comment,
            comments.id as comment_id,
            comments.created,
            news.id as news_id,
            news.section as news_section
            FROM comments
            JOIN news ON comments.news_id = news.id
            JOIN users on comments.user_id = users.id
            WHERE comments.news_id = :news_id
            "
        );

        if ($qstring->execute([
            ':news_id' => $id
        ])){
            $comments = $qstring->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($comments)){
                return $comments;
            } else {
                $comments = null;
                return $comments;
            }
        } else {
            $comments = 'error';
            return $comments;
        }
    }
}

