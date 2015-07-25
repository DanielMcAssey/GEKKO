<?php

return array(

	// General Config
	'ENCRYPTION_KEY'			=> 'REPLACE_THIS_KEY', // Random 32 character string
	'ENABLE_REGISTRATION'		=> true, // Enable user registration
	'WEBSITE_URL'				=> 'http://localhost'
	'USE_HTTPS'					=> false, // Requires a valid SSL cert to function

	// Database Config
	'DB_DRIVER'					=> 'mysql', // sqlite, mysql, pgsql, sqlsrv
	'DB_HOST'					=> 'localhost',
	'DB_NAME'					=> 'forge',
	'DB_USERNAME'				=> 'forge',
	'DB_PASSWORD'				=> '',
	'DB_PREFIX'					=> '',

	// Mail Config
	'MAIL_DRIVER'				=> 'smtp', // smtp, mail, sendmail, mailgun, mandrill, log
	'MAIL_HOST'					=> 'smtp.mailgun.org',
	'MAIL_HOST_PORT'			=> '587',
	'MAIL_HOST_ENCRYPTION'		=> 'tls',
	'MAIL_SMTP_USERNAME'		=> null,
	'MAIL_SMTP_PASSWORD'		=> null,
	'MAIL_FROM_ADDRESS'			=> null,
	'MAIL_FROM_NAME'			=> null,

);

?>