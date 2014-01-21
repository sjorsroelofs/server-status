<?php

require_once('classes/BoxcarApi.php');

class ServerChecker {
	
	private $hosts;
	private $boxcarApiKey;
	private $boxcarApiSecret;
	private $boxcarEmail;

	public function ServerChecker($hosts, $boxcarApiKey, $boxcarApiSecret, $boxcarEmail) {
		$this->hosts			= $hosts;
		$this->boxcarApiKey		= $boxcarApiKey;
		$this->boxcarApiSecret	= $boxcarApiSecret;
		$this->boxcarEmail		= $boxcarEmail;
		
		self::checkConnections();
	}
	
	private function checkConnections() {
		$failure = false;
		
		foreach($this->hosts as $host) {
			if(!$host->isAvailable()) {
				$failure = true;
				break;
			}
		}
		
		return $failure;
	}
	
	public function printResultsHtml() {
		
		echo '
		<style>
		#host-results { text-align: left; font-family: Arial, sans-serif; font-size: 13px; }
		#host-results th,
		#host-results td { padding: 6px; }
		#host-results th { background: #e5e5e5; }
		#host-results td { background: #eee; }
		</style>';
		
		echo '<table id="host-results">';
		echo '<tr><th>Host</th><th>Status</th><th>Error code</th><th>Error description</th></tr>';
		
		foreach($this->hosts as $host) {
			echo '<tr>';
				echo '<td>' . $host->getTitle() . '</td>';
				echo '<td>';
					echo ($host->isAvailable()) ? 'Available': 'Down';
					$error = $host->getError();
				echo '</td>';
				echo '<td>' . $error['errorno'] . '</td>';
				echo '<td>' . $error['errstr'] . '</td>';
			echo '</tr>';
		}
		
		echo '<table>';
		
	}
	
	public function sendPushMessage() {
		if(empty($this->boxcarApiKey) || empty($this->boxcarApiSecret) || empty($this->boxcarEmail)) {
			return false;
		}
	
		$boxcar = new BoxcarApi($this->boxcarApiKey, $this->boxcarApiSecret);
		
		if(!function_exists('curl_init')) {
			trigger_error('CURL must be enabled for boxcar_api to function', E_USER_ERROR);
		}
		
		$message = '';
		
		foreach($this->hosts as $host) {
			if(!$host->isAvailable()) {
				if($message != '') {
					$message .= ', ';
				}
				$message .= $host->getTitle() . ' is down';
			}
		}
		
		if($message != '') {
			$boxcar->notify($this->boxcarEmail, '', $message);
		}
	}
	
}