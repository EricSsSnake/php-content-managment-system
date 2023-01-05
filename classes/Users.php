<?php
class Users
{
    private $conn;
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $type;
    public $deleted;

    function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM cms_user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
