CREATE TABLE users_csv (
  id INT,
  name VARCHAR(100),
  email VARCHAR(255)
)
ENGINE=CONNECT
TABLE_TYPE=CSV
FILE_NAME='/var/lib/mysql/users.csv'
HEADER=1;

CREATE TABLE users_json (
  name VARCHAR(100),
  age INT
)
ENGINE=CONNECT
TABLE_TYPE=JSON
FILE_NAME='/var/lib/mysql/users.json';

CREATE TABLE users_xml (
  id INT,
  name VARCHAR(100),
  age INT
)
ENGINE=CONNECT
TABLE_TYPE=XML
FILE_NAME='/var/lib/mysql/users.xml'
OPTION_LIST='RowTag=person';

###########################################################################################

https://mariadb.com/docs/server/reference/data-types/string-data-types/enum?utm_source=chatgpt.com

CREATE TABLE `enum_test` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `enum_column` enum('N','Y') NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci;

INSERT INTO enum_test (datum) VALUES (NOW());
SELECT * FROM enum_test;

DELIMITER $$
CREATE TRIGGER `test_trigger` BEFORE UPDATE ON `enum_test` FOR EACH ROW BEGIN
END
$$
DELIMITER ;

INSERT INTO enum_test (datum) VALUES (NOW());
SELECT * FROM enum_test;

# 10.6.23 bug
# 10.11.14 bug
# 11.2.2 good
# 11.2.6 good
# 11.3.2 good
# 11.4.8 bug
# 11.8.3 bug
# 12.0.2 bug
# 12.1.1 bug

