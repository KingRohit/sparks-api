<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/doctor.php';

$database = new Database();
$db = $database->connect();
$doctor = new Doctor($db);

$doctor->id = isset($_GET['id']) ? $_GET['id'] : die();

$doctor->read_single();

$doctor_arr = array(
    'id' => $doctor->id,
    'name' => $doctor->name,
    'specialist' => $doctor->specialist
);

print_r(json_encode($doctor_arr));