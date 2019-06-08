<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/doctor.php';

$database = new Database();
$db = $database->connect();
$doctor = new Doctor($db);

$data = json_decode(file_get_contents("php://input"));

$doctor->id = $data->id;
$doctor->name = $data->name;
$doctor->specialist = $data->specialist;

if($doctor->update()){
    echo json_encode(array('inform' => 'Doctor Updated'));
}
else{
    echo json_encode(array('inform' => 'Doctor Not Updated'));
}