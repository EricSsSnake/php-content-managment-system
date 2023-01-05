<?php
include_once "config/Database.php";
include_once "classes/Categories.php";

$database = new Database();
$db = $database->connect();

$categories = new Categories($db);
$result = $categories->read();

if (!empty($result)) {
    $categories_arr = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $categories_item = [
            'name' => $row['name']
        ];

        array_push($categories_arr, $categories_item);
    }
}
