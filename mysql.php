<?php
try
{
    $dbh = new PDO('mysql:host=localhost;dbname=DB_NAME;charset=utf8', 'USERNAME', 'PASSWORD');
}
catch (PDOException $e)
{
    print 'Błąd połączenia z bazą danych.';
    die();
}