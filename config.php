		
		<?php 
		/* 
		* PayPal and database configuration 
		*/ 

		// PayPal configuration 
		define('PAYPAL_ID', 's3806690@student.rmit.edu.au'); 
		define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

		define('PAYPAL_RETURN_URL', 'http://localhost/tutorial4/success.php'); 
		define('PAYPAL_CANCEL_URL', 'http://localhost/tutorial4/cancel.php'); 
		define('PAYPAL_NOTIFY_URL', 'http://127.0.0.1/tutorial4/ipn.php'); 
		define('PAYPAL_CURRENCY', 'AUD'); 

		// Database configuration 
		define('DB_HOST', 'localhost:3306'); 
		define('DB_USERNAME', 'root'); 
		define('DB_PASSWORD', ''); 
		define('DB_NAME', 'ecommercedb'); 


		// Change not required 
		define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?
		"https://www.sandbox.paypal.com/cgi-bin/webscr":
		"https://www.paypal.com/cgi-bin/webscr");

		?>
		
		
		
		