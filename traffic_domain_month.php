<?php

/**
 * Get traffic stats per domain for the current month
 *
 * Recommended frequency: daily
 *
 * @author Israel Viana isra00@gmail.com
 * @license http://www.gnu.org/copyleft/gpl.html
 */

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    include 'init.php';
}

$currentMonth = date('Y-m') . '-1';

$nextMonth = strtotime('+1 months');
$nextMonth = date('Y', $nextMonth) . '-' . date('m', $nextMonth) . '-1';

$sql = <<<SQL
SELECT
    domains.name domain,
    SUM(http_in + http_out + ftp_in + ftp_out + smtp_in + smtp_out + pop3_imap_in + pop3_imap_out) traffic_total
FROM
    DomainsTraffic
JOIN
    domains ON DomainsTraffic.dom_id = domains.id
WHERE
    date BETWEEN '$currentMonth' AND '$nextMonth'
GROUP BY
	domains.name
SQL;

$q = mysqli_query($conn, $sql);

while ($domain = mysqli_fetch_assoc($q)) {
    $domain['traffic_total'] = $domain['traffic_total'] / 1024 / 1024; //Send in MB
    DataDogStatsD::gauge('plesk.traffic.domains', $domain['traffic_total'], 1, array("domain" => $domain['domain'], "month"=>date('F')));
}
