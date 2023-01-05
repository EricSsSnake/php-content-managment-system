<?php
include_once "config/Database.php";
include_once "classes/Posts.php";

$database = new Database();
$db = $database->connect();

$posts = new Posts($db);
$result = $posts->read();

if (!empty($result)) {
    $posts_arr = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $posts_item = [
            'id' => $row['id'],
            'title' => $row['title'],
            'message' => nl2br($row['message']),
            'category_id' => $row['category_id'],
            'userid' => $row['userid'],
            'status' => $row['status'],
            'created' => $row['created'],
            'updated' => $row['updated'],
            'category' => $row['name']
        ];

        array_push($posts_arr, $posts_item);
    }
}
