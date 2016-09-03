<?php
namespace Database;

class DatabaseSelect
{

    protected $sql;

    public function __construct ($table_name, Array $column_name)
    {
        $this->sql = 'SELECT ';
        foreach ($column_name as $value) {
            $this->sql .= "$value,";
        }
        $this->sql = substr($this->sql, 0, - 1);
        $this->sql .= " FROM $table_name ";
    }

    public function startSelect (\PDO $PDO, Array $value)
    {
        $stmt = $PDO->prepare($this->sql);
        $i = 1;
        foreach ($value as $key => $v) {
            $stmt->bindParam($i, $value[$key]);
            $i ++;
        }
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function setWhere (Array $where)
    {
        $this->sql .= 'WHERE ';
        foreach ($where as $v) {
            $this->sql .= "$v=? AND ";
        }
        $this->sql = substr($this->sql, 0, - 4);
        return $this;
    }
}

