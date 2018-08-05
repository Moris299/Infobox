<?php

//AUTOLOAD
$autoload_underscores = function ($classname) {
    $path = str_replace('_', DIRECTORY_SEPARATOR, $classname);
    $path = __DIR__ . "/$path";
    if (file_exists("{$path}.php")) {
        require_once("{$path}.php");
    }
};

$autoload_namespaces = function ($path) {
    if (preg_match('/\\\\/', $path)) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    }
    if (file_exists("{$path}.php")) {
        require_once("{$path}.php");
    }
};

\spl_autoload_register($autoload_namespaces);
\spl_autoload_register($autoload_underscores);

//MYSQL 
require_once('mysql.php');

$birthdays = new generating\birthdays($dbh);
$events = new generating\events($dbh);
$moveableEvents = new generating\moveableEvents($dbh); 
$dailyInfo = new generating\dailyInfo($dbh);

$tpl = new templating\templateEngine("infobox.tpl");

require_once('contents/infobox.php');

echo $tpl->output();