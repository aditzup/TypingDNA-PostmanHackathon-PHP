<?php
    //echo $_POST["username"]."\n".$_POST["password"]."\n".$_POST["tp"]."\n".$_POST["isMobile"];;

    
    $tp = $_POST["tp"];
    $id = hash('ripemd160', $_POST["username"]);
    $base_url = 'https://api.typingdna.com/%s/%s';
    $apiKey= '';
    $apiSecret = '';
    // provide your apiKey from the TypingDNA Dashboard
    
    $ch = curl_init(sprintf($base_url, 'auto', $id));
    $data = array('tp' => $tp);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ":" . $apiSecret);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data) . "\n");

    $response = curl_exec($ch);
    curl_close($ch);
    var_dump($response);

    $obj = json_decode($response);
    
    if(strval($obj->{'action'}) == "enroll")
    {
        $ch = curl_init(sprintf($base_url, 'user', $id));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_USERPWD, $apiKey . ":" . $apiSecret);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $response = curl_exec($ch);
        curl_close($ch);
        //var_dump($response);

        $obj = json_decode($response);
        //print "user enrolled";
        
        if(($_GET["mobile"]) == 0)
        {
            header("Location: login.php?message=User enrolled&auth=".$obj->{'count'});  
        }
        else
        {
            header("Location: login.php?message=User enrolled&auth=".$obj->{'mobilecount'});  
        }
    }
    if(strval($obj->{'action'}) == "verify;enroll")
    {
        header("Location: login.php?message=Authentication successful with keystroke dynamics as 2FA");  
    }
    if(strval($obj->{'action'}) == "verify")
    {
        if(strval($obj->{'result'}) == "1")
        {
            header("Location: login.php?message=Authentication successful with keystroke dynamics as 2FA");
        }
        if(strval($obj->{'result'}) == "0")
        {
            try
            {
                $verificationCode = hash('ripemd160', $_POST["tp"]);
                $emailCode = substr(hash('ripemd160', $verificationCode),-6);
                require 'vendor/autoload.php';
                $email = new \SendGrid\Mail\Mail();
                $email->setFrom("verification@postmanhackathon.co.uk", "Verification API");
                $email->setSubject("Verify email");
                $email->addTo($_POST["username"], "");
                $email->addContent("text/plain", "The verification code is: ".$emailCode);
                $SendGridAPIKey = '';
                //please provide the SendGrid API here
                $sendgrid = new \SendGrid($SendGridAPIKey);

                try
                {
                    $response = $sendgrid->send($email);
                    print $response->statusCode(). "\n";
                    print_r($response->headers());
                    print $response->body(). "\n";
                }
                catch(Exception $e)
                {
                    echo 'Caught exception: ' . $e->getMessage()."\n";
                }    
            }
            catch(Exception $e)
            {
                header("Location: login.php?message=Invalid email address. Unable to verify via email.");
            }

            //header("Location: index.php?message=Typing pattern verification failed, an email has been sent to your email address&tp=".$_GET["tp"]."#one");  
            header("Location: emailverification.php?code=".$verificationCode);
            
        }
    }

    

?>