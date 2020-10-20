<?php 
$array = [
    ['name', 'email'],
    ['Doe, John', 'johndoe@foo'],
    ['Jane Doe', 'janedoe@foo'],
    ['Ron "SuperFly" O\'Neal', 'supafly@foo'],

];
header("Content-type: application/csv");
header("Content-Disposition: attachment; filename=test.csv");

$fp = fopen('php://output', 'w');
foreach ($array as $row) {
    fputcsv($fp, $row);
}
