<?php
//This file should be run at 0:00, everyday 

$url = 'https://api.sunrise-sunset.org/json?lat=52.663941&lng=18.948176&date=';
$url .= date("Y-m-d");
$url .= '&formatted=1';

$data = file_get_contents("$url");

unlink('sunriseAndSunsetTimes.txt');
file_put_contents('sunriseAndSunsetTimes.txt', "$data");