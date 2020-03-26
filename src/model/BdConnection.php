<?php

try
{
    //$bd = new PDO("mysql:host=".MYSQL_HOST.";port=".MYSQL_PORT.";dbname=".MYSQL_DB.";charset=utf8",MYSQL_USER,MYSQL_PASSWORD);
    $dsn = 'mysql:host=localhost;port=3306;dbname=events;charset=utf8';
    $user = 'root';
    $pass = '';
    $bd = new PDO($dsn, $user, $pass);

}
catch(erreur $e)
{
    die('error'.$e->getMessage());
}

?>