<?php
class Model
{
    function __construct()
    {
        $this->db = new Database();
    }

    protected function getUser($username)
    {
        $qstring = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $qstring->execute([
            ':username' => $username
        ]);

        $response = $qstring->fetch(PDO::FETCH_ASSOC);
        return $response;
    }

    protected function getUserByID($id)
    {
        $qstring = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        if ($qstring->execute(
            [
                ':id' => $id
            ]
        )){
            $response = $qstring->fetch(PDO::FETCH_ASSOC);

            if (!empty($response)){
                return $response;
            } else {
                $response = false;
                return $response;
            }

        } else {
            $response = 'error';
            return $response;
        }
    }

    protected function insertUser($username, $password)
    {
        $qstring = $this->db->prepare("INSERT INTO users (username, password)
                                       VALUES (:username, :password)");
        $qstring->execute([
            ':username' => $username,
            ':password' => $password
        ]);

        $id = $this->db->lastInsertId();
        return $id;
    }

    protected function getNews($section = false)
    {
        if (!$section) {
            $qstring = $this->db->prepare('SELECT id, title, alt_content, section FROM news');

            if ($qstring->execute()) {
                $result = $qstring->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                header('Location:' . URI . '/home?err=1');
                exit;
            }
        } else {
            $qstring = $this->db->prepare('SELECT id, title, alt_content, section FROM news WHERE section= :section');

            if ($qstring->execute([
                ':section' => $section
            ])) {
                $result = $qstring->fetchAll(PDO::FETCH_ASSOC);
                if (empty($result)){
                    header('Location:' . URI . '/' . $section . '/no_news');
                }
                return $result;
            } else {
                header('Location:' . URI . '/'. $section .'?err=1');
                exit;
            }
        }
    }
    protected function getNewsForDashboard()
    {
        $qstring = $this->db->prepare ('SELECT id, title, section, created FROM news ORDER BY id DESC');

        if($qstring->execute()){
            $result = $qstring->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            header('Location:' . URI . '/dashboard/editArticles?err=1');
            exit;
        }
    }

    protected function getNewsById($id)
    {
        $qstring = $this->db->prepare ('SELECT id, title, alt_content, main_content, section FROM news WHERE id= :id');

        if($qstring->execute([
            ':id' => $id
        ])){
            $result = $qstring->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($result)){
                return $result;
            }
        } else {
            header('Location:' . URI . '/dashboard/editArticles?err=1');
            exit;
        }
    }
}