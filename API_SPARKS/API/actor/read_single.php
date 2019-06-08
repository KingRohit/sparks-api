<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/actor.php';

$database = new Database();
$db = $database->connect();
$actor = new Actor($db);

$actor->id = isset($_GET['id']) ? $_GET['id'] : die();

$actor->read_single();

$actor_arr = array(
    'id' => $actor->id,
    'name' => $actor->name,
    'industry' => $actor->industry
);

print_r(json_encode($actor_arr));