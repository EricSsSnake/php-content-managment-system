<?php
include_once "../../config/Database.php";
include_once "classes/Posts.php";

$database = new Database();
$db = $database->connect();

$posts = new Posts($db);

$data = json_decode(file_get_contents('php://input'));

$posts->title = $data->title;
$posts->message = $data->message;
$posts->category_id = $data->category_id;
$posts->status = $data->status;
$posts->userid = $data->userid;
$posts->created = $data->created;
$posts->updated = $data->updated;

$posts->create();
