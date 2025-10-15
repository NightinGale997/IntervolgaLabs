<?php

namespace classes\services;

use PDO;

class db
{
    private static $instance;
    private $pdo;
    private $error = [];
    private function __construct(){
        $options = (require __DIR__ . "/settings.php")['db'];
        $this->connect($options);
    }

    private function connect(array $options){
        $this->pdo = new \PDO('mysql:host='.$options['host'].';dbname='.$options['db'], $options['user'], $options['pass']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function query($sql, array $params, $className = null){
        $result = null;
        try {
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute($params);
        } catch (\PDOException $e) {
            if($e->getCode() == 23000){
                $this->error[] = $e->getMessage().": Поля не уникальны ";
            }
            else{
                $this->error[] = $e->getMessage();
            }
        }
        if($result === false){
            return null;
        }
        else{
            if ($className) {
                return $stmt->fetchAll(PDO::FETCH_CLASS, $className);
            } else {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }

    public static function getInstance()
    {
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getError(){
        return $this->error;
    }
}