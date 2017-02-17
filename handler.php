
<?php
    

    include("includes/function.inc.php");
    include("includes/chat.function.inc.php");

     if(isset($_GET['act'])) {
        $act = $_GET['act'];
    } else {
        $act = "default";
    }

    switch($act) {
        default:

            break;

        case 'get_buglist':            
            echo loadBugs($_GET['page']);
            break;
        
        case 'get_bug':
            echo getBugByID(mysql_real_escape_string($_GET['id']));            
            break;
        
        case 'createComment':
            if (isset($_POST['bugID']) && isset($_POST['userID']) && isset($_POST['content'])) {
               echo create_comment(mysql_real_escape_string($_POST['bugID']), mysql_real_escape_string($_POST['userID']), mysql_real_escape_string($_POST['content']));
            } else {               
               echo "createComment: keine Daten übergeben";
            }                       
            break;

        case 'changeStatus':
            echo changeStatus(mysql_real_escape_string($_POST['bugID']), mysql_real_escape_string($_POST['statusID']));
            break;

        case 'changeAssignedToUser':
            echo changeAssignedToUser(mysql_real_escape_string($_POST['bugID']), mysql_real_escape_string($_POST['userID']));
            break;

        case 'changeProgress':
            echo changeProgress(mysql_real_escape_string($_POST['bugID']), mysql_real_escape_string($_POST['new_progress']));
            break;
        
        case 'createBug':
            echo createBug(mysql_real_escape_string($_POST['title']), mysql_real_escape_string($_POST['description']));
            break;

        case 'getConversation':
            echo getConversation(mysql_real_escape_string($_POST['userID']));
            break;
    }
?>