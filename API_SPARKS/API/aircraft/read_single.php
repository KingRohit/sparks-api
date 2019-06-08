<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../Database/Database.php';
include_once '../../Tables/aircraft.php';

$database = new Database();
$db = $database->connect();
$aircraft = new Aircraft($db);

$aircraft->id = isset($_GET['id']) ? $_GET['id'] : die();

$aircraft->read_single();

$aircraft_arr = array(
    'id' => $aircraft->id,
    'name' => $aircraft->name,
    'generation' => $aircraft->generation
);

print_r(json_encode($aircraft_arr));