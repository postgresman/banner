<?php

class DB
{
    private static $instance = null;
    private static $config = null;

    private function __construct () {
        if(!self::$config = include('config/db.php')){
            die("DB config file was failed");
        }

        $query = sprintf("%s:host=%s;dbname=%s",
            self::$config['driver'],
            self::$config['host'],
            self::$config['database']
        );

        try {
            self::$instance = new PDO($query,
                self::$config['username'],
                self::$config['password']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function get_instance(){
        if (self::$instance != null) {
            return self::$instance;
        }

        return new self;
    }

    public function insert($table, $params){
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
            $table,
            implode(",", array_keys($params)),
            implode(",", array_fill(0, count($params), "?"))
        );

        return self::$instance->prepare($sql)->execute(array_values($params));
    }

    public function update($table, $params, $id){
        $sql = sprintf("UPDATE %s SET %s WHERE id = %s",
            $table,
            implode("," , array_map(function($key){return $key."=?";}, array_keys($params))),
            $id
        );

        return self::$instance->prepare($sql)->execute(array_values($params));
    }

    public function select($table, $params){
        $sql = sprintf("SELECT * FROM %s %s",
            $table,
            $params?("WHERE ".implode(" AND " , array_map(function($key){return $key."=:".$key;}, array_keys($params)))):""
        );

        $query = self::$instance->prepare($sql);

        $query->execute($params);

        return $query->fetchAll(PDO::FETCH_ASSOC);;
    }

    public function selectFirst($table, $params){
        return current($this->select($table, $params));
    }
}