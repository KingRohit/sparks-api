<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/aircraft.php';

$database = new Database();
$db = $database->connect();
$aircraft = new Aircraft($db);
$result = $aircraft->read();
$num = $result->rowCount();

if($num > 0){
    $aircraft_arr = array();
    $aircraft_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $aircraft_item = array(
            'id' => $id,
            'name' => $name,
            'generation' => $generation
        );

        array_push($aircraft_arr['data'], $aircraft_item);
    }
    echo json_encode($aircraft_arr);
}

else{
    echo json_encode(
        array('inform' => 'No Aircraft found')
    );
}
