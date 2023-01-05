<?php
session_start();

include_once "../config/Database.php";

$database = new Database;
$root_url = $database->root_url;

session_unset();
session_destroy();
header("location: $root_url");
