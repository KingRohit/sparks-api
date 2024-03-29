<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/actor.php';

$database = new Database();
$db = $database->connect();
$actor = new Actor($db);

$data = json_decode(file_get_contents("php://input"));

$actor->name = $data->name;
$actor->industry = $data->industry;

if($actor->create()){
    echo json_encode(array('inform' => 'Actor Created'));
}
else{
    echo json_encode(array('inform' => 'Actor Not Created'));
}