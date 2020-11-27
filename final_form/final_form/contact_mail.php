

<?php
$toEmail = "panoskiousis@hotmail.com";
$mailHeaders = "From: " . $_POST["your_title"] . "<". $_POST["your_email"] .">\r\n";
if(mail($toEmail, $_POST["comments"], $mailHeaders)) {
echo"<p class='success'>Contact Mail Sent.</p>";
} else {
echo"<p class='Error'>Problem in Sending Mail.</p>";
}
?>
1
2
3
4
5
6
7
8
9
<?php
$toEmail = "pardeepkumargt@gmail.com";
$mailHeaders = "From: " . $_POST["your_title"] . "<". $_POST["your_email"] .">\r\n";
if(mail($toEmail, $_POST["comments"],  $mailHeaders)) {
echo"<p class='success'>Contact Mail Sent.</p>";
} else {
echo"<p class='Error'>Problem in Sending Mail.</p>";
}
?>