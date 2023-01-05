<?php
class Posts
{
    private $conn;
    public $id;
    public $title;
    public $message;
    public $category_id;
    public $userid;
    public $status;
    public $created;
    public $updated;
    public $category;

    function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT p.id, p.title, p.message, p.category_id, p.userid, p.status, p.created, p.updated, c.name FROM cms_posts as p LEFT JOIN cms_category as c ON p.category_id = c.id WHERE p.status = 'published' ORDER BY p.created DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function read_single()
    {
        $query = "SELECT * FROM cms_posts as p LEFT JOIN cms_category as c ON p.category_id = c.id WHERE p.id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->title = $row['title'];
        $this->message = html_entity_decode(nl2br($row['message']));
        $this->category_id = $row['category_id'];
        $this->userid = $row['userid'];
        $this->status = $row['status'];
        $this->created = $row['created'];
        $this->updated = $row['updated'];
        $this->category = $row['name'];
    }
}
