<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../Database/Database.php';
include_once '../../Tables/doctor.php';

$database = new Database();
$db = $database->connect();
$doctor = new Doctor($db);

$data = json_decode(file_get_contents("php://input"));

$doctor->id = $data->id;

if($doctor->delete()){
    echo json_encode(array('inform' => 'Doctor Deleted'));
}
else{
    echo json_encode(array('inform' => 'Doctor Not Deleted'));
}