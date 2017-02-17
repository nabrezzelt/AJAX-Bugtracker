<?php
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

    echo berechneZeitString(360000);    
?>