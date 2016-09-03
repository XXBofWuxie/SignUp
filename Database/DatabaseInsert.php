<?php
namespace Database;

class DatabaseInsert
{

    protected $sql;

    public function __construct (String $table_name)
    {
        $value = NULL;
        $this->sql = "INSERT INTO $table_name ";
    }

    public function setColumn (Array $insert_column)
    {
        $this->sql .= '(';
        foreach ($insert_column as $v) {
            $this->sql .= "$v,";
        }
        $this->sql = substr($this->sql, 0, - 1);
        $this->sql .= ') ';
        return $this;
    }

    public function setValue ($insert_number)
    {
        $this->sql .= 'VALUES (';
        for ($i = 0; $i < $insert_number; $i ++) {
            $this->sql .= '?,';
        }
        $this->sql = substr($this->sql, 0, - 1);
        $this->sql .= ') ';
        return $this;
    }

    public function startInsert (\PDO $PDO, Array $value)
    {
        $stmt = $PDO->prepare($this->sql);
        $i = 1;
        foreach ($value as $Key => $v) {
            $stmt->bindParam($i, $value[$Key]);
            $i ++;
        }
        return $stmt->execute();
    }
}

