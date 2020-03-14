<?php

namespace models;

class News extends \libs\Database
{
    const TABLENAME = 'news';
    const PRIMARY_KEY = 'news_id';
    const AUTHOR = 'author';
    const TITLE = 'title';
    const TEXT = 'text';
    const CATEGORY = 'category';

    public function getNews()
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME);
    }

    public function addNews($data)
    {
        $this->add(self::TABLENAME, $data);
    }

    public function getByTopic($category)
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME, [self::CATEGORY => $category]);
    }

    public function getById($id)
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME, [self::PRIMARY_KEY => $id]);
    }

    public function getLastFour()
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME, [], " ORDER BY date DESC", ' LIMIT 4');
    }

    public function getTopics()
    {
        $this->loadFile(MODELS, 'topics.txt');
        return $this->getResults();
    }

    public function deleteNews($conditions)
    {
        $this->select_or_delete('DELETE', self::TABLENAME, $conditions);
    }
}
