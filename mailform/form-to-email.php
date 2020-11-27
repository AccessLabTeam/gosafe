<?php
/*
This first bit sets the email address that you want the form to be submitted to.
You will need to change this value to a valid email address that you can access.
*/
$webmaster_email = "konstantinos.laliotis@yahoo.gr";

/*
This bit sets the URLs of the supporting pages.
If you change the names of any of the pages, you will need to change the values here.
*/
$feedback_page = "feedback_form.html";
$error_page = "error_message.html";
$thankyou_page = "thank_you.html";

/*
This next bit loads the form field data into variables.
If you add a form field, you will need to add it here.
*/
$date = $_REQUEST['date'] ;
$gender = $_REQUEST['gender'] ;
$age = $_REQUEST['age'] ;
$descript = $_REQUEST['descript'] ;
$lat = $_REQUEST['lat'] ;
$lng = $_REQUEST['lng'] ;


$msg = 
"Date: " . $date . "\r\n" . 
"Gender: " . $gender . "\r\n" . 
"Age: " . $age . "\r\n" . 
"Description: " . $descript . "\r\n" . 
"Latitude: " . $lat . "\r\n" . 
"Longitude: " . $lng ;

/*
The following function checks for email injection.
Specifically, it checks for carriage returns - typically used by spammers to inject a CC list.
*/
function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

// If the user tries to access this script directly, redirect them to the feedback form,
if (!isset($_REQUEST['date'])) {
header( "Location: $feedback_page" );
}

// If the form fields are empty, redirect to the error page.
elseif (empty($descript) || empty($date)) {
header( "Location: $error_page" );
}

/* 
If email injection is detected, redirect to the error page.
If you add a form field, you should add it here.
*/
elseif ( isInjected($date) || isInjected($gender)  || isInjected($desript) ) {
header( "Location: $error_page" );
}

// If we passed all previous tests, send the email then redirect to the thank you page.
else {

	mail( "$webmaster_email", "Feedback Form Results", $msg );

	header( "Location: $thankyou_page" );
}
?>