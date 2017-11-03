<?php

namespace App\Repositories;

use Nette\Database\Context;
use Nette\Database\Table\Selection;

abstract class BaseRepository
{

    /** @var Context */
    private $database;
    private $tableName;

    /**
     * BaseRepository constructor.
     *
     * @param Context $database
     */
    public function __construct(Context $database)
    {
        $this->database = $database;

    }

    public function get(array $criteria = [])
    {
        return $this->getTable()->where($criteria)->fetch();
    }

    /**
     * Find
     *
     * @param array $criteria criteria
     * @param string $order order
     * @param int $limit limit
     * @param int $offset offset
     * @return array|\Nette\Database\Table\IRow[]|Selection
     */
    public function find(array $criteria = [], string $order = 'id DESC', int $limit = null, int $offset = null)
    {
        return $this->getTable()->where($criteria)->order($order)->limit($limit, $offset)->fetchAll();

    }


    /**
     * Create
     *
     * @param array $data
     * @return bool|int|\Nette\Database\Table\IRow
     */
    public function create($data)
    {
        return $this->getTable()->insert($data);
    }

    public function findPairs($value, $key = 'id', $criteria = [], string $order = 'id DESC', int $limit = 10, int $offset = null)
    {
        return $this->getTable()
            ->where($criteria)
            ->order($order)
            ->limit($limit, $offset)
            ->fetchPairs($key, $value);
    }

    /**
     * Delete
     *
     * @param array $criteria criteria
     * @return int
     */
    public function delete(array $criteria)
    {
        return $this->getTable()->where($criteria)->delete();
    }

    /**
     * Update
     *
     * @param array $criteria criteria
     * @param array $data data
     * @return int
     */
    public function update(array $criteria, $data)
    {
        return $this->getTable()->where($criteria)->update($data);
    }

    public function getMaxValue($value)
    {
        return $this->getTable()->max($value);
    }

    public function countRows($column)
    {
        return $this->getTable()->count($column);
    }

    /**
     * @param array $elements
     * @param int $parentId
     * @return array
     */
    public function buildTree(array $elements, $parentId = 1)
    {

        $branch = array();

        foreach ($elements as $element) {

            $element = $element->toArray();

            if ($element['parent_id'] == $parentId) {

                $children = $this->buildTree($elements, $element['id']);

                $element['children'] = [];

                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element['id']] = $element;
            }
        }
        return $branch;
    }

    protected function setTableName(string $tableName)
    {
        $this->tableName = $tableName;
        return $this->tableName;
    }

    protected function getTable(): Selection
    {
        return $this->database->table($this->getTableName() ?? $this->tableName);
    }

    abstract protected function getTableName(): string;


}
