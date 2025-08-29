<?php

Class SQL {

	private $conn;

	public function __construct($host, $port, $user, $pass, $db) {
		$this->conn = mysqli_init();
		mysqli_ssl_set(
			mysql: $this->conn,
			key: '/etc/ssl/pma/php_client.key',
			certificate: '/etc/ssl/pma/php_client.crt',
			ca_certificate: '/etc/ssl/pma/ca.crt',
			ca_path: NULL,
			cipher_algos: NULL
		);
		if (!mysqli_real_connect(
			mysql: $this->conn,
			hostname: $host,
			username: $user,
			password: $pass,
			database: $db,
			port: $port,
			flags: MYSQLI_CLIENT_SSL
		)) {
			throw new Exception('Connect failed!');
		}
	}

	public function oneData($query) {
		try {
			$handle = mysqli_query(mysql: $this->conn, query: $query);
			if ($tomb = mysqli_fetch_array($handle)) {
				return $tomb[0];
			} else {
				return FALSE;
			}
		} catch (Exception $e) {
			echo '<pre class="error">' . $e->getMessage() . '</pre>';
			return FALSE;
		}
	}
}

