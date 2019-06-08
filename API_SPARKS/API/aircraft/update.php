<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/aircraft.php';

$database = new Database();
$db = $database->connect();
$aircraft = new Aircraft($db);

$data = json_decode(file_get_contents("php://input"));

$aircraft->id = $data->id;
$aircraft->name = $data->name;
$aircraft->generation = $data->generation;

if($aircraft->update()){
    echo json_encode(array('inform' => 'Aircraft Updated'));
}
else{
    echo json_encode(array('inform' => 'Aircraft Not Updated'));
}