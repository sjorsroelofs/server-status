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

require_once('config.php');
require_once('classes/Host.php');
require_once('classes/BoxcarApi.php');
require_once('classes/MailClient.php');
require_once('classes/ServerChecker.php');
require_once('hosts.php');


$serverChecker = new ServerChecker($hosts, USER_EMAIL, BOXCAR_API_KEY, BOXCAR_API_SEC, BOXCAR_EMAIL);


if(PRINT_HTML) {
	$serverChecker->printResultsHtml();
}

if(SEND_EMAIL) {
	$serverChecker->sendMailMessage();
}

if(SEND_PUSH) {
	$serverChecker->sendPushMessage();
}