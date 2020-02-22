<?php


namespace Application\model;


use Application\core\Model;

class PostModel extends Model
{

    public function getPosts()
    {
        $sql = 'SELECT * FROM `post`';

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function addPost($data)
    {
        $sql = "INSERT INTO `post` SET `title` = '" . $this->db->escape($data['title']) . "', `content` = '" . $this->db->escape($data['content']) . "', `user_id` = '" . $data['user_id'] . "', `date_added` = NOW()";

        $this->db->query($sql);
    }

    public function addComment($data)
    {
        $sql = "INSERT INTO `comment` SET `topic_id` = '" . (int)$data['topic_id'] . "', `user_id` = '" . (int)$data['user_id'] . "', `author` = '" . $this->db->escape($data['author']) . "', text = '" . $this->db->escape(strip_tags($data['comment'])) . "',  `date_added` = NOW()";

        $this->db->query($sql);
    }



    public function getPost($id)
    {
        $query = $this->db->query("SELECT DISTINCT * FROM `post` WHERE id = '" . (int)$id . "'");

        return $query->row;
    }

    public function getComments($topic_id)
    {
        $sql = 'SELECT * FROM `comment` WHERE topic_id=' . (int)$topic_id;

        $query = $this->db->query($sql);

        return $query->rows;
    }



    public function getTotalPosts()
    {
        $sql = "SELECT COUNT(*) AS total FROM `post`";

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

}