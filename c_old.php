<?php
    session_start();
    
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
                            <li><a href="forum.php">Administration</a></li>
                            <li><a href="c.php">C</a>
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

    <div class="container-fluid" id="app_chat">        
        <button type="button" class="button js-trigger">Users online (45)</button>

        <h1 class="title">&lt;&#047;&gt;</h1>

        <nav class="chat">
            <h2 class="chat__users">Users Online: 45</h2>
            <ul class="chat__wrapper">
                <li class="chat__human">
                    <img class="chat__avatar" src="https://robohash.org/joe" alt="" />
                    <span class="chat__name">Joe Richardson</span>
                </li>
                
                <li class="chat__human">
                    <img class="chat__avatar" src="https://robohash.org/nah" alt="" />
                    <span class="chat__name">Bill Gates</span>
                </li>
                
                <li class="chat__human">
                    <img class="chat__avatar" src="https://robohash.org/ok" alt="" />
                    <span class="chat__name">Steve Jobs</span>
                </li>
                
                <li class="chat__human">
                    <img class="chat__avatar" src="https://robohash.org/hi" alt="" />
                    <span class="chat__name">Mark Zuckerberg</span>
                </li>
                
                <li class="chat__human">
                    <img class="chat__avatar" src="https://robohash.org/bruh" alt="" />
                    <span class="chat__name">Denzel Washington</span>
                </li>
            </ul>
        </nav>

        <div class="conversation">
            <div class="conversation__header">
                Denzel Washington
                <span class="close-msg">&times;</span>
            </div>
            <ul class="conversation__wrap">
                <li class="conversation__msg cf">
                    <span>Hey!</span>
                </li>
                
                <li class="conversation__msg cf">
                    <span class="right">Yo!</span>
                </li>
                
                <li class="conversation__msg cf">
                    <span>How Goes it?</span>
                </li>
                
                <li class="conversation__msg cf">
                    <span class="right">Bruh.</span>
                </li>
            </ul>
            
            <input class="input" type="text" placeholder="Enter Message" />
        </div>
    </div>

<script>$('.js-trigger').on('click', function() {
    $('html').toggleClass('show-me') 
});

$('.conversation__header').on('click', function() {
    $('.conversation').slideToggle(300);
});

$('.chat__name').on('click', function() {
    $('.conversation').slideToggle(300);
});</script>

</body>
</html>
