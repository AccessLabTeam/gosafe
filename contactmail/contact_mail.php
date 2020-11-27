<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$subject = $_POST['subject'];
header('Content-Type: application/json');
if ($name === ''){
  print json_encode(array('message' => 'Το όνομα δεν μπορεί να είναι κενό', 'code' => 0));
  exit();
}
if ($email === ''){
  print json_encode(array('message' => 'Η διεύθυνση ηλεκτρονικού ταχυδρομίου δεν μπορεί να είναι κενή', 'code' => 0));
  exit();
} else {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
  print json_encode(array('message' => 'Μη έγκυρη μορφή ηλεκτρονικού ταχυδρομίου', 'code' => 0));
  exit();
  }
}
if ($subject === ''){
  print json_encode(array('message' => 'Το θέμα δεν μπορεί να είναι κενό', 'code' => 0));
  exit();
}
if ($message === ''){
  print json_encode(array('message' => 'Το μήνυμα δεν μπορεί να είναι κενό', 'code' => 0));
  exit();
}
$content="From: $name \nEmail: $email \nSubject: $subject \nMessage: $message";
$recipient = "accesslabitservices@gmail.com";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $content, $mailheader) or die("Error!");
print json_encode(array('message' => 'Το σχόλιο σας καταχωρήθηκε!', 'code' => 1));
exit();
?>