<?php

class Host {
	
	private $title;
	private $host;
	private $port;
	private $errorno;
	private $errstr;
	
	public function Host($title, $host, $port) {
		$this->title	= $title;
		$this->host		= $host;
		$this->port		= $port;
	}
		
	public function isHostAvailable() {
		$connection = @fsockopen(self::getHost(), self::getPort(), $errorno, $errstr, 10);
		
		if($connection) {
			$this->errorno = $errorno;
			$this->errstr = $errstr;
		
			fclose($connection);
			return true;
		}
		else {
			return false;
		}
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	private function getHost() {
		return $this->host;
	}
	
	private function getPort() {
		return $this->port;
	}
	
	public function getError() {
		return array(
			'errorno'	=> $this->errorno,
			'errstr'	=> $this->errstr
		);
	}
	
}