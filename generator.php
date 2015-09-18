<?php 
	
 	// $argv = array(
 	// 	'$argv1' => 'number of emails',
 	// 	'$argv2' => 'email prefix',
 	// 	'$argv3' => 'email domain',
 	// 	'$argv4' => 'api key',
 	// 	'$argv5' => 'list id'
 	// );

	// variables 
	$emails = array(); // email address array
	$emailcount = $argv[1]; // number of emails
	$apikey = $argv[4]; // MailChimp API key
	$url = 'http://us8.api.mailchimp.com/3.0/lists/' . $argv[5] . '/members'; // API endpoint

	// echo $url; // test endpoint value

	// set values for $emails

	for ($i = 0; $i < $emailcount; $i ++) {
		$emails[$i] = $argv[2] . '+' . $i . '@' . $argv[3];
	};

	// var_dump($emails); // testing output

	// output $emails values to terminal

	foreach ($emails as $email) {
		echo $email . "\r\n";
	};

	// subscribe each $email from $emails to list

	foreach ($emails as $email) {

		// $request is API request

		$request = array(
			'email_address' => $email, //
			'status' => 'subscribed' //
		);

		// start API call

		$ch = curl_init();

		// define $options for API call

		$options = array(
			CURLOPT_USERPWD => "user:".$apikey, // authorization
			CURLOPT_URL => $url, // endpoint
			CURLOPT_USERAGENT => "representing_4.0/themgangstas", // user agent
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true, // call type (POST)
			CURLOPT_POSTFIELDS => json_encode($request) // encoded JSON request
		);

		// set options for CURL request

		curl_setopt_array($ch, $options);

		// make API call, output HTTP response to $response

		$response = json_decode(curl_exec($ch), true); // decoded JSON response 

		// test API response

		var_dump($response);
	}

?>
