<?php

require_once("config.php");
if((isset($_POST['your_title'])&& $_POST['your_title'] !='') &&
(isset($_POST['your_email'])&& $_POST['your_email'] !=''))
{

$yourtitle = $conn->real_escape_string($_POST['your_title']);
$yourEmail = $conn->real_escape_string($_POST['your_email']);
$yourcat= $conn->real_escape_string($_POST['vp_simeiabundle_problem[category]']);
$comments = $conn->real_escape_string($_POST['comments']);
$snapshot = $conn->real_escape_string($_POST['vp_simeiabundle_problem[file]']);

$sql="INSERT INTO Form (title, email, category, comment,snapshot) VALUES ('".$yourtitle."','".$yourEmail."', '".$yourcat."', '".$comments."','".$snapshot."')";


if(!$result = $conn->query($sql)){
die('There was an error running the query [' . $conn->error . ']');
}
else
{
echo "Thank you! We will contact you soon";
}
}
else
{
echo "Please fill Name and Email";
}
?>
