<?php

require_once('connect.php');

header('Content-type: application/json');

$id = $_POST['id'];

$sqlremovedata = $conn->prepare("DELETE FROM prepare_statement WHERE id=?");
$sqlremovedata->bind_param("i", $id);
$sqlremovedata->execute();

$sqlgetdata = "SELECT * FROM prepare_statement";
$data = $conn->query($sqlgetdata);

$output = [];
while($row = $data->fetch_assoc()) {
    $output[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'profession' => $row['profession'],
    ];
}

$data = $conn->query($sqlgetdata);

echo json_encode([
    'id' => $id,
    'data' => $output,
    'message' => 'success'
]);
