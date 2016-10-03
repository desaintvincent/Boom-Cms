<?php


namespace Boom\Model\Orm;


class Query
{
    public $query   = "";

    /*
     * Query parts
     */
    public $fields  = "";
    public $table   = "";
    public $where   = "";
    public $orderBy = "";
    public $groupBy = "";
    public $limit   = "";

    public function query($string)
    {
        $db = DbProvider::getDb();
        $db->query($string);

        return $this;
    }

    public function select($fields)
    {
        $this->fields($fields);

        if (is_array($fields)) {
        	$this->fields(implode(",", $fields));
        }

        return $this;
    }

    public function from($table)
    {
        $this->table = $table;

        return $this;
    }

    public function where($condtion)
    {
        $this->where = "WHERE " . $condtion;

        return $this;
    }

    public function andWhere($condition)
    {
        $this->where += " AND " . $condition;

        return $this;
    }

    public function orWhere($condition)
    {
        $this->where += " OR " . $condition;

        return $this;
    }

    public function groupBy($group)
    {
        $this->groupBy = " GROUP BY " . $group;

        return $this;
    }

    public function orderBy($order)
    {
        $this->orderBy = " ORDER BY " . $order;

        return $this;
    }

    public function limit($limit)
    {
        $this->limit = " LIMIT " . $limit;

        return $this;
    }

    public function join($tableJoined, $tableJoindPrimaryKey = "id", $tableFrom, $foreignKey, $options = [])
    {
        $this->joins[$tableJoined] = " JOIN " . $tableJoined . " ON " . $tableJoined . "." . $tableJoindPrimaryKey . "=" . $tableFrom . "." . $foreignKey;

        if (isset($options['fields'])) {
            $this->joins[$tableJoined]['fields'] = $options['fields'];
        }

        return $this;
    }
}