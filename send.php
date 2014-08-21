<?php
// Here we get all the information from the fields sent over by the form.
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
 
$to = 'rrhh.aveit@gmail.com';
$subject = 'WikiAVEIT';
$message = 'Nombre: '.$name."\n".'Email: '.$email."\n".'Message: '.$message;
$headers = 'From: '.$email . "\r\n";
 
if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // this line checks that we have a valid email address
mail($to, $subject, $message, $headers); //This method sends the mail.
echo "Mensaje Enviado"; // success message
}
else{echo "Invalid Email, please provide an correct email.";}
?>