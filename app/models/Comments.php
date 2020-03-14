<?php

namespace models;

class Comments extends \libs\Database
{
    const TABLENAME = 'comments';
    const PRIMARY_KEY = 'comments_id';
    const NEWS_ID = 'news_id';
    const USERNAME = 'username';
    const TEXT = 'text';

    public function getComments()
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME);
    }

    public function addComment($data)
    {
        $this->add(self::TABLENAME, $data);
    }

    public function getCommentById($id)
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME, [self::PRIMARY_KEY => $id])->getResults()[0];
    }

    public function getCommentsByNewsId($id)
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME, [self::NEWS_ID => $id]);
    }

    public function deleteCommentsByNewsId($id)
    {
        return $this->select_or_delete('DELETE', self::TABLENAME, [self::NEWS_ID => $id]);
    }

    public function deleteComment($comment_id)
    {
        $this->select_or_delete('DELETE', self::TABLENAME, [self::PRIMARY_KEY => $comment_id]);
    }
}
