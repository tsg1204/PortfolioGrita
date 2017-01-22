<?php
if(isset($_POST['email'])) {
    
    $email_to = "";
    
    $email_subject = "website html form submissions";
    
    
    function died($error) {
        // your error code can go here
        echo "We're sorry, but there's errors found with the form you submitted.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
    
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message']) ||
        !isset($_POST['form'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
    
    $name = $_POST['name']; // required
    $email = $_POST['email']; // required
    $message = $_POST['message']; // not required
    $form = $_POST['form']; // not required
    
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";

  if(strlen($error_message) > 0) {
    died($error_message);
  }
    
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
    
$text = "

<body>
    <h1>Message From Tatiana's portfolio Site</h1>
    <table>
        <tr>
            <td>Name: </td>
            <td>$name</td>
        </tr>
        <tr>
            <td>E-mail: </td>
            <td>$email</td>
        </tr>
        <tr>
            <td>Message: </td>
            <td>$message</td>
        </tr>
        <tr>
            <td>Form-name: </td>
            <td>$form</td>
        </tr>
    </table>
</body>
";
    
    
// create email headers
$headers = 'From: '.$email."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $text, $headers);  
?>

<?php
}
die();
?>
