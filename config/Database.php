<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'cms_db';
    private $username = 'root';
    private $password = '';
    private $conn;
    public $root_url = 'http://localhost/php_cms';

    function connect()
    {
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed:' . $e->getMessage();
        }

        return $this->conn;
    }
}
