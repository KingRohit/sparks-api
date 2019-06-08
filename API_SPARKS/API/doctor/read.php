<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/doctor.php';

$database = new Database();
$db = $database->connect();
$doctor = new Doctor($db);
$result = $doctor->read();
$num = $result->rowCount();

if($num > 0){
    $doctor_arr = array();
    $doctor_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $doctor_item = array(
            'id' => $id,
            'name' => $name,
            'specialist' => $specialist
        );

        array_push($doctor_arr['data'], $doctor_item);
    }
    echo json_encode($doctor_arr);
}

else{
    echo json_encode(
        array('inform' => 'No doctor found')
    );
}
