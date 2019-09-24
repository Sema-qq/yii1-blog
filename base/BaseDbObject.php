<?php


namespace base;

use components\Connection;
use PDO;

/**
 * Class BaseDbObject
 */
abstract class BaseDbObject extends BaseModel
{
    private $query;
    private $where = [];
    private $sort;

    abstract function tableName();

    abstract function primaryKey();

    public static function getDb()
    {
        return Connection::getInstance();
    }

    public static function model()
    {
        return new static();
    }

    public function find()
    {
        $this->query = "SELECT * FROM {$this->tableName()} ";
        return $this;
    }

    public function where(array $where)
    {
        $this->where = $where;
        return $this;
    }

    public function one()
    {
        $sth = $this->prepareQuery();
        $sth->execute();
        return $sth->fetchObject(static::class);
    }

    public function findByPk($id)
    {
        $this->query = "SELECT * FROM {$this->tableName()} ";
        $this->where = [$this->primaryKey() => $id];
        $sth = $this->prepareQuery();
        $sth->execute();
        return $sth->fetchObject(static::class);
    }

    public function all()
    {
        $sth = $this->prepareQuery();
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_CLASS, static::class);
    }

    public function sort(array $sort)
    {
        $this->sort = $sort;
    }

    public function insert(array $fieldNames)
    {
        $insertFields = implode(', ', $fieldNames);
        $insertValues = ':' . implode(', :', $fieldNames);
        $this->query = "INSERT INTO {$this->tableName()} ({$insertFields}) VALUES ({$insertValues})";
        $db = self::getDb();
        $sth = $db->prepare($this->query);
        $this->bindValues($sth, $fieldNames);
        if (!$sth->execute()) {
            $this->setError('db', $sth->errorInfo());
            return false;
        }
        $this->{$this->primaryKey()} = $db->lastInsertId();
        return true;
    }

    public function update(array $fieldNames)
    {
        $update = [];
        foreach ($fieldNames as $field) {
            $update[] = "{$field} = :{$field}";
        }
        $updateFields = implode(', ', $update);
        $pkField = $this->primaryKey();
        $this->query = "UPDATE {$this->tableName()} SET {$updateFields} WHERE {$pkField} = :{$pkField}";
        $db = self::getDb();
        $sth = $db->prepare($this->query);
        $sth->bindValue(":{$pkField}", $this->{$pkField});
        $this->bindValues($sth, $fieldNames);
        if (!$sth->execute()) {
            $this->setError('db', $sth->errorInfo());
            return false;
        }
        return true;
    }

    public function deleteById($id)
    {
        $db = self::getDb();
        $this->query = "DELETE FROM {$this->tableName()} WHERE ID = :id";
        $sth = $db->prepare($this->query);
        $sth->bindValue(':id', $id);
        if (!$sth->execute()) {
            $this->setError('db', $sth->errorInfo());
            return false;
        }
        return true;
    }

    private function prepareQuery()
    {
        $db = self::getDb();
        if ($this->where) {
            $this->query .= ' WHERE ';
        }
        foreach (array_keys($this->where) as $key => $name) {
            if ($key !== 0 && $key !== (count($this->where))) {
                $this->query .= ' AND ';
            }
            $this->query .= "$name = :$name";
        }
        if ($this->sort) {
            $this->query .= ' ORDER BY ';
            foreach ($this->sort as $field => $order) {
                $this->query .= "{$field} $order";
            }
        }
        $sth = $db->prepare($this->query);
        foreach ($this->where as $name => $value) {
            $sth->bindValue(":$name", $value);
        }
        return $sth;
    }

    private function bindValues($sth, array $fieldNames)
    {
        foreach ($fieldNames as $field) {
            $sth->bindValue(":$field", $this->{$field});
        }
    }
}
