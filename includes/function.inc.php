<?php 
session_start();

    include("includes/connect.inc.php");


    function loadBugs($page) {
        $re  = "<table id=\"buglist\" class=\"table table-hover\">";
        $re .= "<tr><th>Status</th><th>Date</th><th>Title</th><th>Assigned To</th></tr>";
        
        $page = intval($page);                
        
        if ($page <= 0) {
            $page = 1;
        }

        $offset = 20 * ($page-1);
        //return $page;
        $query = "SELECT * FROM bugs LIMIT 20 OFFSET " . $offset;
        //return $query;
        $res = mysql_query($query)or die("45<br />" . mysql_error());

        while($row = mysql_fetch_assoc($res)) {
            $re .= "<tr data-table-id=\"" . $row['id'] . "\" onclick=\"modalBugShow(" . $row['id'] . "); notify('Bug successfully loaded!', 2);\">
                        <td class=\"status\">" . getStatusNameByID($row['statusID']) . "</td>
                        <td>" . $row['createTime'] . "</td>
                        <td>" . $row['title'] . "</td>
                        <td class=\"assignedTo\">" . getUsernameByID($row['assignedToID']) . "</td>
                    </tr>";
        }
        $re .= "</table>";

        return $re;

    }

    function generatePager() {
        $query = "SELECT * FROM bugs";
        $res = mysql_query($query)or die("45<br />" . mysql_error());
        
        $bugs = mysql_num_rows($res);

        $re = "<ul id=\"pager\" class=\"pagination\">";
        $j = 1;
        for ($i=0; $i < $bugs; $i=$i+20) {

            $re .= "<li data-page=\"$j\"><a href=\"#page=$j\">$j</a>";
            $j++;
        }
        $re .= "</ul>";

        return $re;
    }

    function getUsernameByID($id) {
        $query = "SELECT username FROM `users` WHERE id = $id";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $row = mysql_fetch_assoc($res);

        return $row['username'];
    }

    function getStatusNameByID($id) {
        $query = "SELECT name FROM `status` WHERE id = $id";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $row = mysql_fetch_assoc($res);

        return $row['name'];
    }

    function getCommentsByBugID($id) {
        $query = "SELECT * FROM comments WHERE bugID = $id ";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $re = "";

        if (mysql_num_rows($res) <= 0) {
            $re = "<p style=\"margin-top: 20px;\">No Comments found!</p>";
            return $re;
        }

        while ($row = mysql_fetch_assoc($res)) {
            $re .= "<div class=\"panel panel-default\">
                        <div class=\"panel-body\">" . $row['content'] . "</div>
                        <div class=\"panel-footer\">
                            <div class=\"row\">
                                <div class=\"col-sm-6 text-left\">
                                    <span class=\"glyphicon glyphicon-time\"></span> " . $row['createTime'] . "
                                </div>
                                <div class=\"col-sm-6 text-right\">
                                    Posted by <a href=\"user.php?id=" . $row['userID'] . "\">" . getUsernameByID($row['userID']) . "</a>
                                </div>
                            </div>
                        </div>
                    </div>";
        }

        return $re;
    }

    function getBugByID($id) {
        $query = "SELECT * FROM bugs WHERE id = $id";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $row = mysql_fetch_assoc($res);

        if (mysql_num_rows($res) <= 0) {
            $re = "<p onload=\"notify('No Data found!',3)\">No Data found!</p>";
            return $re;
        }
        $re = " <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                    <h4 class=\"modal-title\">Bug No. #" . $row['id'] . "</h4>
                </div>
                <div class=\"modal-body\">
                    <ul class=\"nav nav-tabs\">
                        <li class=\"active\"><a data-toggle=\"tab\" href=\"#tab_details\">Details</a></li>
                        <li><a data-toggle=\"tab\" href=\"#tab_comments\">Comments</a></li>
                    </ul>    

                    <div class=\"tab-content\">
                        <div id=\"tab_details\" class=\"tab-pane fade in active\">
                             <table class=\"table\">
                                <tr>
                                    <td>Title</td>
                                    <form id=\"form_edit_title\">
                                        <td>
                                            <input type=\"text\" class=\"from-control\" disabled style=\"width: 100%;\" id=\"new_title\" name=\"title\" value=\"" . $row['title'] . "\" />                                        
                                        </td>
                                    </form>                                    
                                    <td>
                                        <a class=\"btn btn-default btn-xs\" id=\"btn_edit_title\"><span class=\"glyphicon glyphicon-pencil\"></span></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <form id=\"edit_description\">
                                        <td>
                                            <textarea name=\"description\" disabled style=\"width: 100%; max-width: 415px;\">" . $row['description'] . "</textarea>                                                                                    
                                        </td>
                                    </form>
                                    <td>
                                        <a class=\"btn btn-default btn-xs\" id=\"btn_edit_description\"><span class=\"glyphicon glyphicon-pencil\"></span></a>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Reported by</td>
                                    <td>
                                        " . getUsernameByID($row['userID']) . "
                                    </td>
                                </tr>
                                <tr>
                                    <td>Create Time</td>
                                    <td>
                                        " . $row['createTime'] . "
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assigned to</td>
                                    <td>
                                        <form id=\"form_edit_assigned_to\">
                                            <select class=\"form-control\" name=\"assignedToUser\" id=\"assignedToUser\">
                                                " . getUsernameList($row['assignedToID']) . "
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Progress</td>
                                    <td>
                                        <div class=\"progress\">
                                            " . generateProgressBar($row['progress']) . "                                                                                        
                                        </div>
                                        <form id=\"form_edit_progress\">
                                            <input type=\"number\" min=\"0\" max=\"100\" style=\"width: 50px;\" value=\"" . $row['progress'] . "\" id=\"new_progress\" name=\"new_progress\" />
                                            <button type=\"submit\" class=\"btn btn-sm btn-default\"><span class=\"glyphicon glyphicon-floppy-disk\"></span></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        <form id=\"form_edit_status\">
                                            <select class=\"form-control\" id=\"new_status\" name=\"status\">
                                            " . getStatusList($row['statusID']) . "
                                            </select>
                                        </form>
                                    </td>
                                </tr>                                
                             </table>
                        </div>    

                        <div id=\"tab_comments\" class=\"tab-pane fade\">
                            <div id=\"comments\">
                                " . getCommentsByBugID($row['id']) . "
                            </div>
                            <hr />  
                                <form id=\"form_create_comment\" action=\"handler.php?act=createComment\" method=\"POST\">                                                      
                                    <div id=\"form_comment\" class=\"form-group\">
                                        <input type=\"hidden\" id=\"bugID\" value=\"" . $row['id'] . "\" />
                                        <input type=\"hidden\" id=\"userID\" value=\"" . $_SESSION['userID'] . "\" />                                   
                                        <label for=\"comment\">Write a comment:</label><br />   
                                        <textarea id=\"comment\" required=\"required\" style=\"width: 100%; height: 100px;\" name=\"content\"></textarea>
                                    </div>
                                    <input type=\"submit\" id=\"btn_create\" class=\"btn btn-default\" value=\"Create\" />
                                </form>               
                        </div>
                    </div>                   
                </div>
                <script type=\"text/javascript\" src=\"js/modal.functions.js\"></script>
                <div class=\"modal-footer\">
                    <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                </div>";

               return $re;
    }

    function generateProgressBar($value) {
        
        if($value <= 33) {
            $bar = "<div class=\"progress-bar progress-bar-danger\" role=\"progressbar\" aria-valuenow=\"$value\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $value%\">
                    " . $value . "%
                    </div>";
        } elseif ($value > 33 && $value <= 66) {
            $bar = "<div class=\"progress-bar progress-bar-warning\" role=\"progressbar\" aria-valuenow=\"$value\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $value%\">
                   " . $value . "%
                   </div>";
        } else {
            $bar = "<div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"$value\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $value%\">
            " . $value . "%
            </div>";
        }
        
        return $bar;
    }

    function create_comment($bugID, $userID, $content) {
        if ($bugID == "" || $userID == "" || $content == "") {
            return "";
        }
        $query = "INSERT INTO `comments` (`bugID`, `content`, `userID`, createTime) VALUES ('$bugID', '$content', '$userID', NOW())";
        //echo $query;
        $res = mysql_query($query)or die("<br />" . mysql_error());

        $id = mysql_insert_id();

        $query = "SELECT * FROM comments WHERE id = $id"; 
        //echo $query;
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $row = mysql_fetch_assoc($res);

        $re = "<div onload=\"notify('Comment saved & loaded!',2);\" class=\"panel panel-default\">
                        <div class=\"panel-body\">" . $row['content'] . "</div>
                        <div class=\"panel-footer\">
                            <div class=\"row\">
                                <div class=\"col-sm-6 text-left\">
                                    <span class=\"glyphicon glyphicon-time\"></span> " . $row['createTime'] . "
                                </div>
                                <div class=\"col-sm-6 text-right\">
                                    Posted by <a href=\"user.php?id=" . $row['userID'] . "\">" . getUsernameByID($row['userID']) . "</a>
                                </div>
                            </div>
                        </div>
                    </div>";
        return $re;
    }

    function getUsernameList($selectedUser) {
        $query = "SELECT id, username FROM users";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $re = "";

        while ($row = mysql_fetch_assoc($res)) {
            if ($row['id'] != $selectedUser) {                            
                $re .= "<option value=\"" . $row['id'] . "\">" . $row['username'] . "</option>";
            } else {
                $re .= "<option selected value=\"" . $row['id'] . "\">" . $row['username'] . "</option>";
            }
        }

        return $re;

    }

    function getStatusList($selectedStatus) {
        $query = "SELECT id, name FROM status";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $re = "";

        while($row = mysql_fetch_assoc($res)) {
           if ($row['id'] != $selectedStatus) {                            
                $re .= "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
            } else {
                $re .= "<option selected value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
            }
        }        
        
        return $re;
    }

    function changeStatus($bugID, $statusID) {        
        $query = "UPDATE bugs SET statusID = '" . $statusID . "' WHERE id = '"  . $bugID . "'";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        return "ok";
    }    

    function changeAssignedToUser($bugID, $userID) {
        $query = "UPDATE bugs SET assignedToID = '" . $userID . "' WHERE id = '"  . $bugID . "'";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        return "ok";
    }

    function changeProgress($bugID, $newProgress) {
        $query = "UPDATE bugs SET progress = '" . $newProgress . "' WHERE id = '"  . $bugID . "'";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        return "ok";
    }

    function createBug($title, $description) {
        $userID = $_SESSION['userID'];
        $progress = 0;
        $statusID = 1;
        
        $query = "INSERT INTO bugs (title, description, userID, assignedToID, progress, statusID) VALUES ('$title', '$description', '$userID', '3', '$progress', '$statusID')";
        $res = mysql_query($query)or die("<br />" . mysql_error());
        
        $query = "SELECT * FROM bugs ORDER BY id DESC LIMIT 1";        
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $row = mysql_fetch_assoc($res);

        return "<tr onclick=\"modalBugShow(" . $row['id'] . "); notify('Bug successfully loaded!', 2);\"><td>" . getStatusNameByID($row['statusID']) . "</td><td>" . $row['createTime'] . "</td><td>" . $row['title'] . "</td><td>" . getUsernameByID($row['assignedToID']) . "</td></tr>";

    }

    function goOnline() {        
        $query = "UPDATE users SET online = '1' WHERE id = '" . $_SESSION['userID'] . "'";       
        $res = mysql_query($query)or die("<br />" . mysql_error());
    }

    function goOffline() {
        $query = "UPDATE users SET online = '0' WHERE id = '" . $_SESSION['userID'] . "'";        
        $res = mysql_query($query)or die("<br />" . mysql_error());
    }

    function getUserLevelByID($id) {
        $query = "SELECT userlevel FROM users WHERE id = " . $id;
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $row = mysql_fetch_assoc($res);

        return $row['userlevel'];
    }

    function getAccountdetails($id) {
        $query = "SELECT * FROM users WHERE id = " . $id;
        $res = mysql_query($query)or die("<br />" . mysql_error());
        $row = mysql_fetch_assoc($res);

        $re  = "<h4>Accountname: <small>" . $row['username'] . "</small></h4>";
        $re .= "<h4>UserLevel: <small></small></h4>";
        $re .= "<h4>Locked? <small></small></h4>";

        return $re;        
    }
 ?>