<?php

/**
 * Number of clients
 *
 * Recommended frequency: daily
 *
 * @author Israel Viana isra00@gmail.com
 * @license http://www.gnu.org/copyleft/gpl.html
 */
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    include 'init.php';
}

$sql = <<<SQL
SELECT
    COUNT(id) count
FROM
    clients
SQL;

$q = mysqli_query($conn, $sql);
$count = mysqli_fetch_assoc($q);
DataDogStatsD::gauge('plesk.clients.count', $count['count']);
