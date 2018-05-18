<?php
//mysql configuration:

try
{
    $dbh = new PDO('mysql:host=localhost;dbname=DATABASE;charset=utf8', 'USER', 'PASSWORD');
}
catch (PDOException $e)
{
    print 'Błąd połączenia z bazą danych.';
    die();
}