<?php
namespace Boom\Model;

use Boom\Model\Orm\DbProvider;

class Model
{
    public $name;
    public $table;
    //public $db;

    public function __construct($data = null)
    {
        if ($data) {
            $this->forge($data);
        }

        if (!isset($this->db)) {
            $this->db = DbProvider::getDb();
        }

        $this->setTableName();
    }

    private function setTableName()
    {
        $classname = get_class($this);

        if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
            if (!$this->name) {
                $this->name = $matches[1];
            }
            if (!$this->table) {
                $this->table = strtolower($matches[1]) . 's';
            }
        }
    }

    public function forge($data)
    {
        $this->data = $data;
        foreach ($data as $name => $value) {
            $this->$name = $value;
        }

        return $this;
    }

    public function get($conditions, $table)
    {
        $query = "SELECT ";
        if (!isset($conditions['fields'])) {
            $query .= "*";
        } else {
            $query .= $conditions['fields'];
        }

        if (is_null($table)) {
            $query .= " FROM " . $this->table;
        } else {
            $query .= " FROM " . $table;
        }

        // Si on doit faire un join
        if (isset($conditions['joins'])) {
            $joins = [];
            foreach ($conditions['joins'] as $j) {
                if (!isset($this->joins) || !isset($this->joins[$j])) {
                    echo "Le model " . $this->name . " n'a pas d'association avec la table $j ! Veuillez créer un tableau public \$relations dans votre model " . $this->name;
                } else {
                    $joins[] = " JOIN $j ON $j.id = {$this->table}." . $this->joins[$j];
                }
            }
            $query .= implode(" ", $joins);
        }

        // Si on a un Where
        if (isset($conditions['where'])) {
            if (!is_array($conditions['where'])) {
                $query .= " WHERE " . $conditions['where'];
            } else {
                $query .= " WHERE ";
                $cond = [];
                foreach ($conditions['where'] as $k => $v) {
                    if (!is_numeric($v)) {
                        $v = "'" . addslashes($v) . "'";
                    }
                    $cond[] = "$k=$v";
                }
                $query .= implode(' AND ', $cond);
            }
        }

        // Si on a un group by
        if (isset($conditions['groupBy'])) {
            $query .= " GROUP BY " . $conditions['groupBy'];
        }

        // Si on a un order
        if (isset($conditions['order'])) {
            $query .= " ORDER BY " . $conditions['order'];
        }

        // Si on a une limite
        if (isset($conditions['limit'])) {
            if (isset($conditions['offset'])) {
                $query .= " LIMIT " . $conditions['offset'] . "," . $conditions['limit'];
            } else {
                $query .= " LIMIT " . $conditions['limit'];
            }
        }

        $req = $this->db->query($query);
        $results = $req->fetchAll();

        if (isset($conditions['hasMany'])) {
            foreach ($conditions['hasMany'] as $hm => $v) {
                foreach ($results as $r) {
                    $fields = isset($v['fields']) ? $v['fields'] : '*';
                    $groupby = isset($v['groupBy']) ? ' GROUP BY ' . $v['groupBy'] : '';
                    $q = "SELECT $fields FROM $hm WHERE " . strtolower($this->name) . "_id = " . $r->id . $groupby;
                    $pdost = $this->db->query($q);
                    $r->$hm = $pdost->fetchAll();
                }
            }
        }

        return $results;
    }

    public function find($what = 'all', $conditions = null, $table = null)
    {
        if (is_null($table)) {
            $table = $this->table;
        }

        if (is_int($what)) { // le cas ou on chrche un id
            if (empty($conditions['where'])) {
            	$conditions['where'] = ['id' => $what];
            } else {
                $conditions['where'][] = ['id' => $what];
            }

            $what = "first";
        }

        if (is_string($what) || is_null($what)) {
            switch ($what) {
                case "first":
                    $conditions['limit'] = 1;
                    $results = $this->get($conditions, $table);
                    if (empty($results)) {
                        return null;
                    }
                    $results = $results[0];
                    break;
                case "last":
                    $conditions['order'] = 'id DESC';
                    $conditions['limit'] = 1;
                    $results = $this->get($conditions, $table);
                    break;
                default:
                    $results = $this->get($conditions, $table);
                    break;
            }
        }

        return $results;
    }

    public function save($data = [], $table = null)
    {
        $fields = $values = $tmp = [];

        if ($table == null) {
            $table = $this->table;
        }

        if (empty($data)) {
            $data = $this->data;
        }

        if (isset($data['id'])) {
            return $this->update($data['id'], $data, $table);
        } elseif (isset($data->id)) {
            return $this->update($data->id, $data, $table);
        }

        foreach ($data as $k => $v) {
            $fields[] = $k;
            $tmp[] = ':' . $k;
            $values[':' . $k] = htmlentities($v, ENT_QUOTES, "UTF-8");
        }

        $fields = "(" . implode(',', $fields) . ")";
        $tmp = "(" . implode(',', $tmp) . ")";
        $sql = 'INSERT INTO ' . $table . ' ' . $fields . ' VALUES ' . $tmp;

        $pdost = $this->db->prepare($sql);

        try {
            $pdost->execute($values);
            return true;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function update($id, $data =null, $table = null)
    {
        $values = $tmp = [];

        if (is_null($data)) {
            $data = $this->data;
        }

        if ($table == null) {
            $table = $this->table;
        }

        foreach ($data as $d => $v) {
            $values[':' . $d] = htmlentities($v, ENT_QUOTES, "UTF-8");
            $tmp[] = $d . "=:" . $d;
        }

        $tmp = implode(',', $tmp);

        $sql = 'UPDATE ' . $table . ' SET ' . $tmp . ' WHERE id = ' . $id;
        $pdost = $this->db->prepare($sql);
        try {
            $pdost->execute($values);
            return true;
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function delete($id, $table = null)
    {
        if ($table == null) {
            $table = $this->table;
        }

        $this->db->query("DELETE FROM " . $table . " WHERE id=$id");
    }

}