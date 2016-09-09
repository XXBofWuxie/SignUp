<?php
namespace Database;

class DatabaseInsert
{

    protected $sql;

    protected $columnNumber;

    public function __construct ()
    {
        $this->sql = array(
                'table_name' => '',
                'column_name' => '',
                'value' => ''
        );
        $this->columnNumber = 0;
    }

    public function setColumn (Array $column)
    {
        $this->columnNumber = count($column);
        $this->sql['column_name'] = '(';
        foreach ($column as $v) {
            $this->sql['column_name'] .= "$v,";
        }
        $this->sql['column_name'] = substr($this->sql['column_name'], 0, - 1);
        $this->sql['column_name'] .= ') ';
        return $this;
    }

    public function setValue (Bool $column_number = FALSE)
    {
        if ($column_number != FALSE) {
            $this->columnNumber = $column_number;
        }
        $this->sql['value'] = 'VALUES (';
        for ($i = 0; $i < $this->columnNumber; $i ++) {
            $this->sql['value'] .= '?,';
        }
        $this->sql['value'] = substr($this->sql['value'], 0, - 1);
        $this->sql['value'] .= ') ';
        return $this;
    }

    public function startInsert (\PDO $PDO, Array $value)
    {
        $stmt = $PDO->prepare(implode($this->sql));
        $i = 1;
        foreach ($value as $Key => $v) {
            $stmt->bindParam($i, $value[$Key]);
            $i ++;
        }
        return $stmt->execute();
    }
}

