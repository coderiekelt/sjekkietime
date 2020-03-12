<?php

include_once '../vendor/autoload.php';

$sjekkieTime = new \SjekkieTime\SjekkieTime();
$sjekkieTime->load(__DIR__ . '/../schedules');

$sjekkieTime->serve(array_key_exists('s', $_GET) ? $_GET['s'] : 'sjekkie');