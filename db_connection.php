<?php
    $host = 'localhost';
    $user = 'root';
    $pw = 'java1004';
    $db_name = 'dbname';
    $db_port = 3306;
    
    $db_connection = mysqli_connect($host, $user, $pw, $db_name, $db_port);
    $db_connection->set_charset("utf8");

    function mq($sql) {
        global $db_connection;
        return mysqli_query($db_connection, $sql);
    }

?>