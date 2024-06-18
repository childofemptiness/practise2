<?php

require './config.php';

class Database {
    
    private $pdo;

    private static $instance = null;

    public function __construct() {

        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

        $this->pdo = new PDO($dsn, DB_USER, DB_PASS);

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInctance() {

        if (self::$instance === null) {

            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query($sql, $params = []) {

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($params);

        return $stmt;
    }
}