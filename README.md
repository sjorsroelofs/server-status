What's my server status?!
=============

A simple PHP script to check the online status of your server(s) and get notifications by Mail or Boxcar (iOS push notifications).

Install instructions:
-	Change hosts.example.php to hosts.php and add your hosts to the array
-	Change config.example.php to config.php and insert your preferences
-	Run check.php to check if your servers are available
-	If you want to run it as a cronjob, you can call check.php in your cronjob


Server requirements:
-	Apache
-	PHP 5(+)
-	CURL (configured with PHP)
-	Any cronjob software


Setting up a cronjob on Ubuntu with Crontab:
-	Be sure that you've got a copy of the repo from GitHub on your server, and you
	know the absolute path to it
-	Be sure you know the absolute path to your php install (e.g. "/usr/bin/php")
-	If you haven't installed Crontab already, do it by running the command
	"sudo apt-get install gnome-schedule"
-	Run "crontab -e" and select your favourite editor
-	At the end of the file, add your cron rule "*/10 * * * * [absolute path
	to your php installation] -q [absolute path to the check.php file]".
	This will run the script once every 10 minutes
-	Save the file and off you go! :)
-	To check if the script is functioning, you can run
	"sudo [absolute path to php] [absolute path to check.php]"


ToDo:
-	Create instructions for setting up a Boxcar service
-	Catch Boxcar errors when unable to send message


Potential ToDo:
-	Create log functionality
-	Create functionality to prevent cron-spam when a server is down for a longer period