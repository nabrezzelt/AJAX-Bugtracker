<?php

     include("includes/connect.inc.php");   
     include("includes/function.inc.php");

     echo $_POST['username'];
     echo $_POST['password'];

     $username = mysql_real_escape_string($_POST['username']);
     $username = strtolower($username); //Umwandel in klein Buchstaben
     $password = mysql_real_escape_string($_POST['password']);
     $hash_password = hash('sha256', $password);
     //echo $hash_password;
     $abfrage = "SELECT * FROM `users` WHERE `username` = '" . $username . "'";
     //echo $abfrage;
     $res = mysql_query($abfrage)or die("<br />" . mysql_error());
     $row = mysql_fetch_assoc($res);
           

     $db_userid = $row['id'];
     $db_username = $row['username'];     
     $db_password = $row['password'];
     $db_userlevel = $row['userlevel'];
     $db_locked = $row['locked'];             

        
     //----

     if ($db_userid != "") {
        if ($hash_password == $db_password) {
            //übergebendeparameter festlegen:
            $_SESSION['logged_in'] = true;
            
            $_SESSION['userID'] = $db_userid;
            $_SESSION['username'] = $db_username;
            goOnline();
            //Weiterleiten
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=main.php#page=1\">";
            
        } else {
            //Password not correct
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?error=Password%20is%20not%20correct%21\">";
        }    
     } else {
            //Benutername existiert nicht
            //echo "<strong>Login failed - User not exists!</strong> Please try again!";

            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?error=User%20does%20not%20exists%21\">";
     }
?>