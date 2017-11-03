<?php

namespace App\Repositories;

class RelationsRepository extends BaseRepository
{
    private $tableName;

    public function attach($tableName, $columns)
    {
        $this->tableName = $tableName;
        $this->getTable()->insert($columns);
    }

    public function updateRelation($tableName, $columns, $criteria = [])
    {
        $this->tableName = $tableName;
        $this->getTable()->where($criteria)->update($columns);

    }

    public function deleteRelation($tableName, $criteria = [])
    {
        $this->tableName = $tableName;
        return $this->getTable()->where($criteria)->delete();

    }

    public function getItemsOfRelations($row, $sort = null, string $finalTable)
    {
        $result = [];
        if ($row) {
            foreach ($row->related($finalTable)->order($sort) as $item) {
                $result[] = $item->{$finalTable};
            }
            return $result;
        } else {
            return false;
        }

    }

    public function getItemOfRelations($row, $sort = null, string $finalTable)
    {
        $result = [];
        if ($row) {
            foreach ($row->related($finalTable)->order($sort) as $item) {
                $result[] = $item->{$finalTable};
            }
            return $result;
        } else {
            return false;
        }

    }

    public function getItemsPairsOfRelations($tableName, array $criteria, $key, $value = null)
    {
        $this->tableName = $tableName;
        return $this->getTable()->where($criteria)->fetchPairs($key, $value);
    }

    public function hasNodes($items = null)
    {
        if ($items) {
            return true;
        } else {
            return false;
        }
    }

    protected function getTableName(): string
    {
        return $this->tableName;
    }

}