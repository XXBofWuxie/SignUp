<?php
namespace Database;

class StaticPdo extends InterfaceStaticPdo
{
    
    public static function DBConnect()
    {
        try {
            //$dsn 的例子如下
            //$dsn = 'mysql:dbname=testdb;host=127.0.0.1'
            $dsn = 'mysql:dbname='. StaticPdo::DB_NAME .';host='. StaticPdo::DB_HOST;
            static::$PDO = new \PDO($dsn, StaticPdo::DB_USER, StaticPdo::DB_PWD);
            static::$PDO->setAttribute( \PDO::ATTR_EMULATE_PREPARES, FALSE);
            static::$PDO->exec('SET NAMES utf8');
            return static::$PDO;
        } catch (\PDOException $e) {
            error_log($e->getMessage());
            echo json_encode(6);
            exit();
        }
    }

}

