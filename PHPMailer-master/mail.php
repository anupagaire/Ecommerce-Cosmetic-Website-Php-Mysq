

<?php
$conn=mysqli_connect("fdb6.awardspace.net","2503644_sonu","Bhupender@420","2503644_sonu");

$email=$_REQUEST["email"];
$query=mysqli_query($conn,"select * from register where email='$email'");
$row=mysqli_fetch_array($query);


require 'PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer();
  
  //Enable SMTP debugging.
  $mail->SMTPDebug = 0;
  //Set PHPMailer to use SMTP.
  $mail->isSMTP();
  //Set SMTP host name
  $mail->Host = "mail.sonukashyap.dx.am";
  $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
  //Set this to true if SMTP host requires authentication to send email
  $mail->SMTPAuth = TRUE;
  //Provide username and password
  $mail->Username = "webadmin@sonukashyap.dx.am";
  $mail->Password = "Rahul@420";
  //If SMTP requires TLS encryption then set it
  $mail->SMTPSecure = tls;
  $mail->Port = 25;
  //Set TCP port to connect to
  
  $mail->From = "webadmin@sonukashyap.dx.am";
  $mail->FromName = "jignesh";
  
  $mail->addAddress($row["email"]);
  
  $mail->isHTML(true);
 
  $mail->Subject = "test mail";
  $mail->Body = "<i>this is your password:</i>".$row["pass"];
  $mail->AltBody = "This is the plain text version of the email content";
  if(!$mail->send())
  {
echo "Email Not Exit";
  }
  else
  {
   echo "Your Password has been sent successfully Please Check Your Email";
  }