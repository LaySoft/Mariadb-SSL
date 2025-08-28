<style>
body {
	background-color: #000000;
	color: #FFFFFF;
}
.ok {
	color: #00DD00;
}
.error {
	color: #DD0000;
}
</style><?php

error_reporting(E_ALL); ini_set('display_errors', TRUE);

echo '<h1 class="ok">PHP: ' . PHP_VERSION . '</h1>';

define('MYSQLI', mysqli_init());

/*
mysqli_ssl_set(
	mysql: MYSQLI,
	key: '/etc/ssl/pma/php_client.key',
	certificate: '/etc/ssl/pma/php_client.crt',
	ca_certificate: '/etc/ssl/pma/ca.crt',
	ca_path: NULL,
	cipher_algos: NULL
);
*/

if (mysqli_real_connect(
	mysql: MYSQLI,
	hostname: 'maxscale',
	username: 'lufi',
	password: 'lufilufi',
	database: 'LUFI',
	port: 4000
)) {
	echo '<h1 class="ok">MariaDB connection OK</h1>';
} else {
	die('<h1 class="error">MariaDB connection ERROR!</h1>');
}

function Query($query) {
	try {
		return mysqli_query(mysql: MYSQLI, query: $query);
	} catch (Exception $e) {
		echo '<pre class="error">' . $e->getMessage() . '</pre>';
		return FALSE;
	}
}

if ($handle = Query("SELECT VERSION()")) {
	echo '<h1 class="ok">Version: ' . mysqli_fetch_array($handle)[0] . '</h1>';
}

if ($handle = Query("SHOW STATUS LIKE 'Ssl_cipher'")) {
	if ($cipher = mysqli_fetch_array($handle)[1]) {
		echo '<h1 class="ok">Connection encrypted: ' . $cipher . '</h1>';
	} else {
		echo '<h1 class="error">Connection not encrypted!</h1>';
	}
}

if ($handle = Query("SELECT NOW()")) {
	echo '<h1 class="ok">' . mysqli_fetch_array($handle)[0] . '</h1>';
}

die('<code class="ok">' . sha1(microtime()) . '</code>');

