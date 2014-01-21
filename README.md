What's my server status?!
=============

A simple PHP script to check the online status of your server(s).

Install instructions:
-	Change hosts.example.php to hosts.php and add your hosts to the array
-	Run check.php to check if your servers are available
-	If you want to run it as a cronjob, you can call check.php in your cronjob


ToDo:
-	Create email notifier
-	Check cron functionality
-	Create better instructions for setting up cronjobs
-	Create instructions for setting up a Boxcar service


Potential ToDo:
-	Create log functionality
-	Create functionality to prevent cron-spam when a server is down for a longer period