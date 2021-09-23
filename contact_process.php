<?php
    
    try {

    
        $to      = $_POST["our_email"];
        $subject = $_POST["subject"]." ".$_POST["name"]++;
        $message = $_POST["message"];
        $headers = 'From: '.$_POST["email"].''       . "\r\n" .
                     'Reply-To: webmaster@example.com' . "\r\n" .
                     'X-Mailer: PHP/' . phpversion();
    
        mail($to, $subject, $message, $headers);

        echo "exito"; 
    } catch (Exception $e) {
        echo false; 
    }
?>