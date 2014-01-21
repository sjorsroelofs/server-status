<?php

require_once('config.php');
require_once('classes/Host.php');
require_once('classes/BoxcarApi.php');
require_once('classes/ServerChecker.php');
require_once('hosts.php');


$serverChecker = new ServerChecker($hosts, BOXCAR_API_KEY, BOXCAR_API_SEC, BOXCAR_EMAIL);


if(PRINT_HTML) {
	$serverChecker->printResultsHtml();
}

if(SEND_PUSH) {
	$serverChecker->sendPushMessage();
}