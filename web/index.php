<?php

error_reporting(E_ALL); ini_set('display_errors', TRUE);

define('MYSQLI', mysqli_init());

mysqli_ssl_set(
	mysql: MYSQLI,
	key: '/etc/ssl/pma/client.key',
	certificate: '/etc/ssl/pma/client.crt',
	ca_certificate: '/etc/ssl/pma/ca.crt',
	ca_path: NULL,
	cipher_algos: NULL
);

if (mysqli_real_connect(
	mysql: MYSQLI,
	hostname: 'mariadb',
	username: 'lufi',
	password: 'lufilufi',
	database: 'LUFI'
)) {
	echo '<h1>Connection OK</h1>';
} else {
	die('<h1>Connection ERROR!</h1>');
}

function Query($query) {
	try {
		return mysqli_query(mysql: MYSQLI, query: $query);
	} catch (Exception $e) {
		echo '<pre>' . $e->getMessage() . '</pre>';
		return FALSE;
	}
}

if ($handle = Query("SELECT VERSION()")) {
	echo '<h1>Version: ' . mysqli_fetch_array($handle)[0] . '</h1>';
}

if ($handle = Query("SHOW STATUS LIKE 'Ssl_cipher'")) {
	echo '<h1>Cipher: ' . mysqli_fetch_array($handle)[1] . '</h1>';
}

if ($handle = Query("SELECT NOW()")) {
	echo '<h1>' . mysqli_fetch_array($handle)[0] . '</h1>';
}

die('<code>' . sha1(microtime()) . '</code>');

