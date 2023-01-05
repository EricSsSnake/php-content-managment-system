<?php
session_start();

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

    function login()
    {
        $query = "SELECT * FROM cms_user WHERE email = :email AND password = :password LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $_SESSION['email']);
        $stmt->bindParam(':password', $_SESSION['password']);
        $stmt->execute();
        return $stmt;
    }

    function read()
    {
        $query = "SELECT * FROM cms_user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
