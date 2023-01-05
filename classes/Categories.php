<?php
class Categories
{
    private $conn;
    public $id;
    public $name;

    function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM cms_category";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
