<?php 
    $db_verbindung = mysql_connect("localhost", "root", "ascent", "bugtracker");
    $connected_db = mysql_select_db("bugtracker") or die ("<p>Datenbank nicht gefunden oder fehlerhaft</p>");
 ?>