<?php
include 'config.inc.php';
class Database {
    private $host   = HOST;
    private $dbname = DBNAME;
    private $user   = USER;
    private $pass   = PASS;

    private $db     = null;

    function __construct() {
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $this->db = new PDO($dsn,$this->user,$this->pass);
    }

    function getDatabase() {
        $this->db->query("SET NAMES utf8;");
        return $this->db;
    }

    function getDatabaseError() {
        $this->db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->db;
    }
}