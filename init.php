<?php

/**
 * Common boostrap routines from cron jobs
 *
 * @author Israel Viana isra00@gmail.com
 * @editor Stefan Eiermann github@ultraapp.de
 * @license http://www.gnu.org/copyleft/gpl.html
 */

include_once 'vendor/datadogstatsd.php';

define('DATADOG_APIKEY', 'your datadog api key');
define('DATADOG_APPKEY', 'your datadog app key');
define('DATADOG_SITE', 'https://app.datadoghq.eu');

define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'admin');
define('MYSQL_PASSWORD', 'your admin pasword');
define('MYSQL_DB', 'psa');

$conn = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

DataDogStatsD::configure(DATADOG_APIKEY, DATADOG_APPKEY, DATADOG_SITE);

