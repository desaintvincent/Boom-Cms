<?php
namespace Boom\Model;

use Boom\Model\Orm\DbProvider;

class Model
{
    public $name;
    public $table;
    //public $db;
    public $appname;

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



}