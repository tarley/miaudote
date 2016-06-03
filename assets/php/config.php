<?php

/*
define('DB_HOST', 'localhost');
define('DB_NAME', 'adote');
define('DB_USER', 'root');
define('DB_PASS', '');
*/
/**/
define('CONTEXT_NAME', '/');
define('LOG_DIR', $_SERVER['DOCUMENT_ROOT'] . CONTEXT_NAME . 'log/');
define('DB_HOST', 'ns702.hostgator.com.br');
define('DB_NAME', 'tarley_adote');
define('DB_USER', 'tarley_adote');
define('DB_PASS', 'Miaudote2016');
define ( 'CHARSET', 'utf8' );

include "logger.php";
/*
Logger("========================================================================");
Logger("CONTEXT_NAME=" . CONTEXT_NAME);
Logger("LOG_DIR=" . LOG_DIR);
Logger("DB_HOST=" . DB_HOST);
Logger("DB_NAME=" . DB_NAME);
Logger("DB_USER=" . DB_USER);
Logger("DB_PASS=" . DB_PASS);
Logger("========================================================================");
*/