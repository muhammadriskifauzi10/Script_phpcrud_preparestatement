<?php

session_start();

$servename = 'localhost';
$username = 'root';
$password = '';
$db_name = 'dev_php';

$conn = new mysqli($servename, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
