<?php 
    include("includes/connect.inc.php");    

    function getOnlineUserList() {
        $query = "SELECT id, username FROM users WHERE online = '1' AND id != '" . $_SESSION['userID'] . "'";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $re = "";

        while($row = mysql_fetch_assoc($res)) {
            $re .= "<li><a class=\"getConversation\" href=\"#\" data-account-id=\"" . $row['id'] . "\"><img src=\"" . getProfilPicture($row['id']) . "\" class=\"img-circle\" width=\"28\" height=\"28\" alt=\"Default Profile Picture\"> " . $row['username'] . "</a></li>";
        }
        return $re;        
    }

    function getConversation($userID) {
        $query = "SELECT * FROM conversations WHERE (userA = '" . $_SESSION['userID'] . "' AND userB = '" . $userID . "') OR (userB = '" . $_SESSION['userID'] . "' AND userA = '" . $userID . "')";                                
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $row = mysql_fetch_assoc($res);
        $conversationID = $row['id'];        

        $query = "SELECT *, UNIX_TIMESTAMP() - UNIX_TIMESTAMP(sendDate) AS timeFormat FROM messages WHERE conversationID = '" . $conversationID . "'";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        
        $re = "<div data-conversation-id=\"" . $conversationID . "\" class=\"conversation\">
                        <div class=\"conversation_header\" onClick=\"$(this).parent().remove();\">
                            <img src=\"" . getProfilPicture($userID) . "\" class=\"img-circle\" alt=\"Default Profile Picture\" height=\"28\" width=\"28\"> " . getUsernameByID($userID) . " <span class=\"close\">&times;</span>
                        </div>  
                        <div class=\"conversation_messages\">";


        while($row = mysql_fetch_assoc($res)) {                                                   
            if ($row['userID'] == $_SESSION['userID']) {
                //Text-Right
                $re .= "<span class=\"message message-outgoing\">" . $row['content'] . "<p class=\"timestamp text-right\">" . berechneZeitString($row['timeFormat']) . "</p></span>";
            } else {
                //Text-Left
                $re .= "<span class=\"message message-incoming\">" . $row['content'] . "<p class=\"timestamp\">" . berechneZeitString($row['timeFormat']) . "</p></span>";
            }
        }

        $re .=         "</div>
                        <input type=\"text\" class=\"inputbox\" name=\"tbMessage\" id=\"tbMessage\" placeholder=\"Enter Message\" />
                    </div>";       

        return $re;
    }

    function getProfilPicture($userID) {
        return "images/profilePictures/default.png";
    }

    function berechneZeitString($seconds) {
        if ($seconds > 60) {
            //Mehr als eine Minute              
            if ($seconds > 3600) {
                if ($seconds > 86400) {
                    //Mehre Tage 
                    return "vor " . (int) ($seconds / 86400) . " Tagen";
                }
                //Mehr als eine Stunde
                return "vor " . (int) ($seconds / 3600) . " Stunden";
            }
            return "vor " . (int)( $seconds / 60) . " Minuten";
        } else {
            return "vor $seconds Sekunden";
        }
    }
    
?>
