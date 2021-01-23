<?php
    /*
    echo $_POST["emailcode"]. " " . $_POST["code"] ." ". 
    substr(hash('ripemd160', "d8913df37b24c97f28f840114d05bd110dbb2e44"),-6)." ".
    substr(hash('ripemd160',  trim($_POST["code"])),-6);;
    */

    if($_POST["emailcode"] == substr(hash('ripemd160', trim($_POST["code"])) ,-6))
    {
        //echo "Correct Code";
        header("Location: login.php?message=Authentication successful with email verification as fallback");  
    }
    else
    {
        header("Location: login.php?message=Email code incorrect. Please try again");  
    }
    
?>