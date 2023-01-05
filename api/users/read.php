<?php
include_once "config/Database.php";
include_once "classes/Users.php";

$database = new Database();
$db = $database->connect();

$users = new Users($db);
$result = $users->read();

if (!empty($result)) {
    $users_arr = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $users_item = [
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'password' => $row['password'],
            'type' => $row['type'],
            'deleted' => $row['deleted'],
        ];

        array_push($users_arr, $users_item);
    }
}
