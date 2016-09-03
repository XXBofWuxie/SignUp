<?php
namespace Database;

class DatabaseInfoExist
{

    public static function infoExist (\PDO $PDO, String $table_name, 
            Array $where_value)
    {
        $sql = "SELECT 1";
        $sql .= " FROM $table_name WHERE ";
        $sql .= static::makeValue($where_value);
        $sql .= " LIMIT 1";
        $stmt = $PDO->prepare($sql);
        $i = 1;
        foreach ($where_value as $key=>$value) {
            $stmt->bindParam($i, $where_value[$key]); 
            $i ++;
        }
        $stmt->execute();
        return $stmt->rowCount();
    }

    protected static function makeValue (Array $where_value)
    {
        $sql = '';
        foreach ($where_value as $key => $value) {
            $sql .= "$key=? AND ";
        }
        $sql = substr($sql, 0, - 4);
        return $sql;
    }
}

