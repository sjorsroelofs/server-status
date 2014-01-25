<?php

/*
The MIT License (MIT)

Copyright (c) 2014 Sjors Roelofs

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

class ServerChecker {
	
	private $hosts;
	private $userEmail;
	private $boxcarApiKey;
	private $boxcarApiSecret;
	private $boxcarEmail;

	public function ServerChecker($hosts, $userEmail, $boxcarApiKey, $boxcarApiSecret, $boxcarEmail) {
		$this->hosts			= $hosts;
		$this->userEmail		= $userEmail;
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
	
	public function sendMailMessage() {
		if(!empty($this->userEmail)) {
			$mailClient = new MailClient(USER_EMAIL);
			
			$message = '';
			
			foreach($this->hosts as $host) {
				if(!$host->isAvailable()) {
					if($message != '') {
						$message .= "\n";
					}
					
					$error = $host->getError();
					
					$message .= $host->getTitle() . ' is down. Error code: ' . $error['errorno'] . ', Error message: ' . $error['errstr'] . "\n";
				}
			}
			
			$mailClient->sendMail($message);
		}
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