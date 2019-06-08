<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/actor.php';

$database = new Database();
$db = $database->connect();
$actor = new Actor($db);

$data = json_decode(file_get_contents("php://input"));

$actor->id = $data->id;
$actor->name = $data->name;
$actor->industry = $data->industry;

if($actor->update()){
    echo json_encode(array('inform' => 'Actor Updated'));
}
else{
    echo json_encode(array('inform' => 'Actor Not Updated'));
}