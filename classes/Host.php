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
		
	public function isAvailable() {
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