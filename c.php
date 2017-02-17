<?php
    
    // include("includes/chat.function.inc.php");
    // include("includes/function.inc.php");

    // if(!$_SESSION['logged_in'])
    // {
    //     echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?error=Please%20login%20first%21\">";
    // }
?>

<!DOCTYPE html>
<html>

<head>
    <title>C</title>

    <meta charset="ISO-8859-1" />
    <meta name="description" content="" />
    <meta name="author" content="Nabrezzelt" />
    <meta name="keywords" content="" />

    <link href="styles/style.css" type="text/css" rel="stylesheet" />    
    <link href="favicon.ico" type="image/x-icon" rel="shortcut icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/slate/bootstrap.min.css" />
    <link rel="stylesheet" href="https://www.tutorialspoint.com/jquery/src/alertify/alertify.core.css" />
    <link rel="stylesheet" href="https://www.tutorialspoint.com/jquery/src/alertify/alertify.default.css" />

    <script src="https://www.tutorialspoint.com/jquery/src/alertify/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>

    
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">

                <div class="container-fluid">
                    <!-- Titel und Schalter werden fuer eine bessere mobile Ansicht zusammengefasst -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Navigation ein-/ausblenden</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="main.php">Bugtracker</a>
                    </div>

                    <!-- Alle Navigationslinks, Formulare und anderer Inhalt werden hier zusammengefasst und koennen dann ein- und ausgeblendet werden -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="main.php">Bugs</a></li>
                            <li><a href="adminpanel.php">Administration</a></li>                            
                        </ul>

                        <ul class="nav navbar-nav navbar-right">                                
                                 <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                    </div>
                                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                                </form>
                                <p class="navbar-text logged_in_as" style="padding-left: 10px;">Logged in as <a href="acp.php"><?php echo $_SESSION['username'] ?></a></p>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="acp.php">Accountpanel</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
    
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" id="userList">
                <li class="sidebar-brand text-uppercase">                    
                        Users online                   
                </li>
                <?php echo getOnlineUserList();?>                
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

    <div class="container-fluid" id="app_chat">        
        <button type="button" id="btnShowUserList" class="button js-trigger btnPosition">Users online (2)</button>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Simple Sidebar</h1>
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->        
    </div>

    <div class="conversations">
        <div data-conversation-id="1" class="conversation ">
            <div class="conversation_header">
                <img src="images/profilePictures/default.png" class="img-circle" alt="Default Profile Picture" height="28" width="28"> Nabrezzelt <span class="close">&times;</span>
            </div>  
            <div class="conversation-messages">
                <span class="message message-incoming">Sersi<p class="timestamp">vor 1min</p></span>
            </div>
            <input type="text" class="inputbox" name="tbMessage" id="tbMessage" placeholder="Enter Message" />  
        </div> 
        <div data-conversation-id="3" class="conversation hidden">
            <div class="conversation_header">
                <img src="images/profilePictures/default.png" class="img-circle" alt="Default Profile Picture" height="28" width="28"> Tim <span class="close">&times;</span>
            </div>  
            <div class="conversation_messages">
                <span class="message message-incoming">Hey!<br> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sedt ut et dolore magna erat, sed diam voluptua.<p class="timestamp">vor 10min</p></span>
                <span class="message message-outgoing">Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<p class="timestamp text-right">vor 9min</p></span>
                <span class="message message-incoming">At vero eos et et duo dolores.<p class="timestamp">vor 8min</p></span>
                <span class="message message-outgoing">Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<p class="timestamp text-right">vor 7min</p></span>
                <span class="message message-incoming">Hey!<br> Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sedt ut et dolore magna erat, sed diam voluptua.<p class="timestamp">vor 6min</p></span>
                <span class="message message-outgoing">Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<p class="timestamp text-right">vor 5min</p></span>
                <span class="message message-incoming">At vero eos et et duo dolores.<p class="timestamp">vor 4min</p></span>
                <span class="message message-outgoing">Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<p class="timestamp text-right">gerade eben</p></span>
            </div>
            <input type="text" class="inputbox" name="tbMessage" id="tbMessage" placeholder="Enter Message" />
        </div>       
    </div>

<!--
    <div class="conversations">
            <div style="display: block;" class="conversation">
                <div class="conversation_header">
                    Denzel Washington
                    <span class="close-msg">×</span>
                </div>
                <ul class="conversation_wrap">
                    <li class="conversation__msg cf"><span>Hey!</span></li>                   
                    <li class="conversation__msg cf"><span class="right">Yo!</span></li>
                    <li class="conversation__msg cf"><span>How Goes it?</span></li>
                    <li class="conversation__msg cf"><span class="right">Bruh.</span></li>
                </ul>
                <input class="input" placeholder="Enter Message" type="text">
            </div>
            <div style="display: block;" class="conversation">
                <div class="conversation_header">
                    Denzel Washington
                    <span class="close-msg">&times;</span>
                </div>
                <ul class="conversation_wrap">
                    <li class="conversation__msg cf"><span>Hey!</span></li>                   
                    <li class="conversation__msg cf"><span class="right">Yo!</span></li>
                    <li class="conversation__msg cf"><span>How Goes it?</span></li>
                    <li class="conversation__msg cf"><span class="right">Bruh.</span></li>
                </ul>
                <input class="input" placeholder="Enter Message" type="text">
            </div>-->
        </div>

<script>
    $("#btnShowUserList").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        $(this).toggleClass("btnPosition");
    });               
</script>
<script type="text/javascript" src="js/chat.functions.js"></script>
<script type="text/javascript" src="js/notify.js"></script>
</body>
</html>
