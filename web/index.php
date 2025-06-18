<?php

error_reporting(E_ALL); ini_set('display_errors', TRUE);

echo '<h1>MySQL version: ' . mysqli_fetch_array(mysqli_query(mysqli_connect('mariadb', 'lufi', 'lufilufi'), "SELECT VERSION()"), MYSQLI_NUM)[0] . '</h1>';

echo '<h1>' . sha1(microtime()) . '</h1>';

