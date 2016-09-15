<?php
namespace Database;

class DatabaseSelect
{

    protected $sql;

    public function __construct ()
    {
        $this->sql = array(
                'table_name' => '',
                'column_name' => '',
                'where' => '',
                'limit' => '',
                'order' => ''
        );
    }

    /**
     * Set table name part of SQL.
     *
     * @param string $table_name
     *            <p>Select table.</p>
     * @return \Database\DatabaseSelect
     */
    public function setTable (string $table_name)
    {
        $this->sql['table_name'] .= $table_name;
        return $this;
    }

    /**
     * Set column name part of SQL.
     *
     * @param array $column_name
     *            <p>Name of the selected column.</p>
     * @return \Database\DatabaseSelect
     */
    public function setColumnName (Array $column_name)
    {
        foreach ($column_name as $value) {
            $this->sql['column_name'] .= $value . ',';
        }
        $this->sql['column_name'] = substr($this->sql['column_name'], 0, - 1);
        return $this;
    }

    /**
     * Set the where part of SQL.
     *
     * @param array $where_value
     *            <p>The column of where
     *            condition.<br><br>$where = array($column_name,...)<br><br>If
     *            $column_name contains
     *            'LIKE' or 'NOTLIKE', the SQL will be explained as like pattern.</p>
     * @return \Database\DatabaseSelect
     */
    public function setWhere (Array $where)
    {
        $this->sql['where'] = 'WHERE ';
        foreach ($where as $v) {
            if (strpos($v, 'LIKE')) {
                if (strpos($v, 'NOTLIKE')) {
                    $v = substr($v, 7);
                    $this->sql['where'] .= "$v NOT LIKE ? AND ";
                } else {
                    $v = substr($v, 4);
                    $this->sql['where'] .= "$v LIKE ? AND ";
                }
            } else {
                $this->sql['where'] .= "$v=? AND ";
            }
        }
        $this->sql = substr($this->sql, 0, - 4);
    }

    /**
     * Set the limit part of SQL.
     *
     * @param int $max
     *            <p>Max num of selected data.</p>
     * @return \Database\DatabaseSelect
     */
    public function setLimitMax (int $max)
    {
        $this->sql['limit'] = "LIMIT $max";
        return $this;
    }

    /**
     * Set the limit part of SQL.
     *
     * @param int $min
     *            <p>Min line of data.</p>
     * @param int $max
     *            <p>Max line of data.<br><br>Default to int -1. (The last line
     *            of data.)</p>
     * @return \Database\DatabaseSelect
     */
    public function setLimitRange (int $min, int $max = -1)
    {
        $this->sql['limit'] = "LIMIT $min,$max";
        return $this;
    }

    /**
     * Set the Order part of SQL.
     *
     * @param string $order_column
     *            <p>Order by column.</p>
     * @param bool $desc
     *            <p>If use the DESC.<br><br>Default to FALSE.(Do not use.)</p>
     * @return \Database\DatabaseSelect
     */
    public function setOrder (string $order_column, bool $desc = FALSE)
    {
        $this->sql['order'] = "ORDER BY $order_column" . ($desc ? 'DESC' : '');
        return $this;
    }

    /**
     * Start to select.
     *
     * @param \PDO $PDO
     *            <p>Instance of PDO.</p>
     * @param array $bind_value
     *            <p>Bind value about where and limit part of SQL.</p>
     * @return mixed <p>FALSE on failure.<br><br>Array of data on success.</p>
     */
    public function startSelect (\PDO $PDO, Array $bind_value)
    {
        $comb_SQL = 'SELECT ' . $this->sql['column_name'] . ' FROM ' .
                 $this->sql['table_name'] . ' ' . $this->sql['where'] . ' ' .
                 $this->sql['limit'] . ' ' . $this->sql['order'];
        $stmt = $PDO->prepare($comb_SQL);
        $i = 1;
        foreach ($bind_value as $key => $value) {
            $stmt->bindParam($i, $bind_value[$key]);
            $i ++;
        }
        if ($stmt->execute()) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            error_log($stmt->errorInfo());
            return FALSE;
        }
    }
}
    



