<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/actor.php';

$database = new Database();
$db = $database->connect();
$actor = new Actor($db);
$result = $actor->read();
$num = $result->rowCount();

if($num > 0){
    $actor_arr = array();
    $actor_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $actor_item = array(
            'id' => $id,
            'name' => $name,
            'industry' => $industry
        );

        array_push($actor_arr['data'], $actor_item);
    }
    echo json_encode($actor_arr);
}

else{
    echo json_encode(
        array('inform' => 'No Actor found')
    );
}
