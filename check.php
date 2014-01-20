<?php

require_once('classes/Host.php');
require_once('hosts.php');


echo '<table>';
echo '<tr><th>Host</th><th>Status</th><th>Error code</th><th>Error description</th></tr>';
foreach($hosts as $host) {
	$error = $host->getError();

	echo '<tr>';
		echo '<td>' . $host->getTitle() . '</td>';
		echo '<td>';
			echo ($host->isHostAvailable()) ? 'Available': 'Down';
		echo '</td>';
		echo '<td>' . $error['errorno'] . '</td>';
		echo '<td>' . $error['errstr'] . '</td>';
	echo '</tr>';
}
echo '<table>';



echo '<pre>';
print_r($hosts);
echo '</pre>';
