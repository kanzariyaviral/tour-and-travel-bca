<?php

$email="kaznariyaviral2312002@gmail.com";
                                
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;
                
                require 'vendor/autoload.php';
                
                $mail = new PHPMailer(true);
                
                try {
                    $mail->SMTPDebug = 0;                                       
                    $mail->isSMTP();                                            
                    $mail->Host       = 'smtp.gmail.com;';                    
                    $mail->SMTPAuth   = true;                             
                    $mail->Username   = 'alankarholiday47@gmail.com';                 
                    $mail->Password   = 'Alankar@111#';                        
                    $mail->SMTPSecure = 'tls';                              
                    $mail->Port       = 587;  
                
                    $mail->setFrom('alankarholiday47@gmail.com', 'Name');           
                    $mail->addAddress('kaznariyaviral2312002@gmail.com');
                    $mail->addAddress('receiver2@gfg.com', 'Name');
                    
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'Password reset';
                    $mail->Body    = 'Hi, $username. Click here too reset your password http://localhost/tour/forgotpass.php?email=kaznariyaviral2312002@gmail.com';
                    $mail->AltBody = 'Thank You';
                    $mail->send();
                    $log="Message sent successfully...";
                } catch (Exception $e) {
                    $showError= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                
                











                
        
    //     else{
    //         $showError = "No Email Found";

    //     }
    // }
?>