Instalation instructions;

Edit the file application/config/config.php and change this variables:

$config['ftp_host'] 			= "127.0.0.1";  // change to the IP address of your FTP server
$config['server_domain'] 		= 'yourdomain.com'; //change to your domain
$config['server_email']  		= 'youremail@yourdomain.com'; // change to your email
$config['email_message'] 		= " We just received some files from you "; // edit the message that will be sent to users.

Plase note that this system only works with ip address for ftp_host.

The system will work only with ftps, but can work with http or https.
The system shoud alert if any necessary stuff.
