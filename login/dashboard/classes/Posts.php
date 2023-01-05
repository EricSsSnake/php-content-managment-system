<?php
class Posts
{
    private $conn;
    public $title;
    public $message;
    public $category_id;
    public $userid;
    public $status;
    public $created;
    public $updated;

    function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT p.id, p.title, p.message, p.category_id, p.userid, p.status, p.created, p.updated, c.name, u.first_name, u.last_name FROM cms_posts as p INNER JOIN cms_category as c ON p.category_id = c.id INNER JOIN cms_user as u ON p.userid = u.id ORDER BY p.created DESC LIMIT 0,15";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
