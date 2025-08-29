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

/*

define('MYSQLI', mysqli_init());

mysqli_ssl_set(
	mysql: MYSQLI,
	key: '/etc/ssl/pma/php_client.key',
	certificate: '/etc/ssl/pma/php_client.crt',
	ca_certificate: '/etc/ssl/pma/ca.crt',
	ca_path: NULL,
	cipher_algos: NULL
);

//$host = 'mariadb'; $port = 3306;
$host = 'maxscale'; $port = 4443;

if (mysqli_real_connect(
	mysql: MYSQLI,
	hostname: $host,
	username: 'lufi',
	password: 'lufilufi',
	database: 'LUFI',
	port: $port,
	flags: MYSQLI_CLIENT_SSL
)) {
	echo '<h1 class="ok">Connection OK</h1>';
} else {
	die('<h1 class="error">Connection ERROR!</h1>');
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

$ch = curl_init('http://maxscale:8989/v1/maxscale');
curl_setopt($ch, CURLOPT_USERPWD, 'admin:mariadb');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$maxscale = json_decode($response, TRUE);
echo '<pre>' . print_r($maxscale, TRUE) . '</pre>';

$ch = curl_init('http://maxscale:8989/v1/sessions');
curl_setopt($ch, CURLOPT_USERPWD, 'admin:mariadb');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$sessions = json_decode($response, TRUE);

$handle = Query("SELECT CONNECTION_ID()");
$conn_id = mysqli_fetch_array($handle)[0];

foreach ($sessions['data'] as $session) {
	if ($session['attributes']['connections'][0]['connection_id'] == $conn_id) {
		echo '<h1 class="ok">Maxscale connection encrypted: ' . $session['attributes']['client']['cipher'] . '</h1>';
		break;
	}
}

if ($handle = Query("SHOW STATUS LIKE 'Ssl_cipher'")) {
	if ($cipher = mysqli_fetch_array($handle)[1]) {
		echo '<h1 class="ok">Server connection encrypted: ' . $cipher . '</h1>';
	} else {
		echo '<h1 class="error">Server connection not encrypted!</h1>';
	}
}

if ($handle = Query("SHOW SESSION STATUS LIKE 'Ssl_cipher%'")) {
	if ($cipher = mysqli_fetch_array($handle)[1]) {
		echo '<h1 class="ok">Client connection encrypted: ' . $cipher . '</h1>';
	} else {
		echo '<h1 class="error">Client connection not encrypted!</h1>';
	}
}

*/

include 'SQL.php';

try {
	$mysqli = new SQL(
		host: 'mariadb',
		port: 3306,
		user: 'lufi',
		pass: 'lufilufi',
		db: 'LUFI'
	);
	echo '<h1 class="ok">Mariadb connection success! Version: ' . $mysqli->oneData("SELECT VERSION()"). '</h1>';
	if ($ssl = $mysqli->oneData("SELECT VARIABLE_VALUE FROM information_schema.GLOBAL_STATUS WHERE VARIABLE_NAME = 'SSL_VERSION'")) {
		echo '<h1 class="ok">MariaDB connection encrypted: ' . $ssl . '</h1>';
	}
	echo '<h1 class="ok">' . $mysqli->oneData("SELECT NOW()") . '</h1>';
} catch (Exception $e) {
	echo '<h1 class="error">' . $e->getMessage() . '</h1>';
}

try {
	$mysqli = new SQL(
		host: 'maxscale',
		port: 4443,
		user: 'lufi',
		pass: 'lufilufi',
		db: 'LUFI'
	);
	$ch = curl_init('http://maxscale:8989/v1/maxscale');
	curl_setopt($ch, CURLOPT_USERPWD, 'admin:mariadb');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	$maxscale = json_decode($response, TRUE);
	echo '<h1 class="ok">Maxscale connection success! Version: '. $maxscale['data']['attributes']['version'] . '</h1>';

	$ch = curl_init('http://maxscale:8989/v1/sessions');
	curl_setopt($ch, CURLOPT_USERPWD, 'admin:mariadb');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	$sessions = json_decode($response, TRUE);

	$conn_id = $mysqli->oneData("SELECT CONNECTION_ID()");

	foreach ($sessions['data'] as $session) {
		if ($session['attributes']['connections'][0]['connection_id'] == $conn_id) {
			echo '<h1 class="ok">Maxscale connection encrypted: ' . $session['attributes']['client']['cipher'] . '</h1>';
			break;
		}
	}

	echo '<h1 class="ok">' . $mysqli->oneData("SELECT NOW()") . '</h1>';
} catch (Exception $e) {
	echo '<h1 class="error">' . $e->getMessage() . '</h1>';
}

die('<code class="ok">' . sha1(microtime()) . '</code>');

