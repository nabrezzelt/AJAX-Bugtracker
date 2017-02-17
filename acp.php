<?php
    
    include("includes/function.inc.php");
    if(!$_SESSION['logged_in'])
    {
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?error=Please%20login%20first%21\">";
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Accountpanel</title>

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

    <div class="container">        
        <div class="panel panel-default main_frame" style="margin-top: 70px;">
            <div class="panel-heading">
                <h2>Accountpanel</h2>
            </div>          
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a data-toggle="tab" href="#tab_account">Accountdaten</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#tab_myReports">Meine Reports</a></li>
                    <li role="presentation"><a data-toggle="tab" href="#tab_assignedToMe">Zugewiesenen Bugs</a></li>
                    <?php
                        if(getUserLevelByID($_SESSION['userID']) > 2) {
                            echo "<li role=\"presentation\"><a data-toggle=\"tab\" href=\"#tab_administration\">Administration</a></li>";
                        }
                    ?>                    
                </ul>
                <div class="tab-content">
                    <div id="tab_account" class="tab-pane fade in active">
                        <?php echo getAccountdetails($_SESSION['userID']); ?>
                    </div>
                    <div id="tab_myReports" class="tab-pane fade">
                        <p>Meine Reports:</p>
                    </div>
                    <div id="tab_assignedToMe" class="tab-pane fade">
                        <p>Mir zugewiesene Bugs:</p>
                    </div>
                    
                    <?php
                        echo "<div id=\"tab_administration\" class=\"tab-pane fade\">
                                <p>Administration:</p>
                              </div>";
                    ?>
                </div>    
            </div>                                            
        </div>
    </div>

    <script type = "text/javascript" language = "javascript">
        
    </script>
    <script type="text/javascript" src="js/notify.js"></script>
</body>
</html>
