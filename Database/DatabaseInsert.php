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

    /**
     * Set the table name.
     * 
     * @param string $table_name
     *            <p>The name of the operated table.</p>
     * @return \Database\DatabaseInsert
     */
    public function setTableName (string $table_name)
    {
        $this->sql['table_name'] = $table_name;
        return $this;
    }

    /**
     * Set column part of SQL
     *
     * @param Array $column
     *            <p>Insert column.</p>
     * @return Class \Database\DatabaseInsert
     */
    public function setColumn (Array $column)
    {
        $this->columnNumber = count($column);
        $this->sql['column_name'] = '(';
        foreach ($column as $v) {
            $this->sql['column_name'] .= "$v,";
        }
        $this->sql['column_name'] = substr($this->sql['column_name'], 0, - 1);
        $this->sql['column_name'] .= ')';
        return $this;
    }

    /**
     * Set value part of SQL
     *
     * @param Int $column_number
     *            <p>Num of columns. Default to NULL.<br/><br/>Without using
     *            setColumn method. It is compulsory.</p>
     * @return Class \Database\DatabaseInsert
     */
    public function setValue ($column_number = NULL)
    {
        if ($column_number != NULL) {
            $this->columnNumber = $column_number;
        }
        $this->sql['value'] = '(';
        for ($i = 0; $i < $this->columnNumber; $i ++) {
            $this->sql['value'] .= '?,';
        }
        $this->sql['value'] = substr($this->sql['value'], 0, - 1);
        $this->sql['value'] .= ')';
        return $this;
    }

    /**
     *
     * @param PDO $PDO
     *            <p>Instance of class PDO.</p>
     * @param array $bind_value
     *            <p>Insert value.</p>
     * @return boolean TRUE/FALSE
     *         <p>TRUE on success or FALSE on failure.</p>
     */
    public function startInsert (\PDO $PDO, Array $bind_value)
    {
        $comb_sql = 'INSERT INTO ' . $this->sql['table_name'] . ' ' .
                 $this->sql['column_name'] . ' VALUES ' . $this->sql['value'];
        $stmt = $PDO->prepare($comb_sql);
        $i = 1;
        foreach ($bind_value as $Key => $v) {
            $stmt->bindParam($i, $bind_value[$Key]);
            $i ++;
        }
        if ($stmt->execute()) {
            return TRUE;
        } else {
            error_log($stmt->errorInfo());
            return FALSE;
        }
    }
}

