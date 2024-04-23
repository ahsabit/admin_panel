<?php
    $db_hostname = 'localhost';
    $db_username = 'liliput';
    $db_password = 'db4lili';
    $db_database = 'axonspear';
    $connection = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);
    session_start();