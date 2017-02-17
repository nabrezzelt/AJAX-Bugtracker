var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


var tech = getUrlParameter('technology');
var blog = getUrlParameter('blog');


/* ------------------------------------------------------------ */

//Get Hash-Change:

//Example: http://example.com/blah#123 to http://example.com/blah#456

$(window).on('hashchange', function() {
    alert(window.location.hash);
});




function createComment(bugID, userID, content) {
    $.ajax({
        type: 'POST',
        url: 'handler.php?act=createComment',
        data: {
            'bugID' : bugID,
            'userID' : userID,            
            'content' : content
        }
    });
    
    $(document).ready(function(event) {
        $("#comments").append($.post('handler.php?act=createComment', {"bugID": bugID, "userID":userID, "content":content}));
        $.post('handler.php?act=createComment', {"bugID": bugID, "userID":userID, "content":content});
    });
      
}

        $(document).ready(function () {
            $('#form_create_comment').Submit(function (event) {
                event.preventDefault();

                if ($('#comment').val() != "") {
                    $.ajax({
                        type: 'POST',
                        url: 'handler.php?act=createComment',
                        data: $('#from_create_comment').serialize()
                    });  

                    $(document).ajaxSuccess(function(event, xhr, settings){
                        $("#comments").append(xhr.responseText);               
                    });
                }
            });
        });





//Working:

function createComment(bugID, userID, content) {            
            if ($('#comment').val() != "") {
                $.ajax({
                    type: 'POST',
                    url: 'handler.php?act=createComment',
                    data: {
                        'bugID' : bugID,
                        'userID' : userID,            
                        'content' : content
                    }
                });  

                $(document).ajaxSuccess(function(event, xhr, settings){
                    $("#comments").append(xhr.responseText);               
                    });
                }                 
        }

       

    $.ajax({type: 'POST', url: '', data: { 'bugID' : bugID, 'userID' : userID, 'content' : content } }); $(document).ajaxSuccess(function(event, xhr, settings){ alert(xhr.responseText); $("#comments").append(xhr.responseText); }); 








$('form_create_comment').submit(function(event) {
    // Das eigentliche Absenden verhindern
    event.preventDefault();
    
    // Das sendende Formular und die Metadaten bestimmen
    var form = $(this); // Dieser Zeiger $(this) oder $("form"), falls die ID form im HTML exisitiert, klappt übrigens auch ohne jQuery ;)
    var action = form.attr('action'), // attr() kann enweder den aktuellen Inhalt des gennanten Attributs auslesen, oder setzt ein neuen Wert, falls ein zweiter Parameter gegeben ist
        method = form.attr('method'),
        data   = form.serialize(); // baut die Daten zu einem String nach dem Muster vorname=max&nachname=Müller&alter=42 ... zusammen
        
    // Der eigentliche AJAX Aufruf
    $.ajax({
        url : action,
        type : method,
        data : data
    }).done(function (data) {
        // Bei Erfolg
        alert('Erfolgreich:' + data);
    }).fail(function() {
        // Bei Fehler
        alert('Fehler!');
    }).always(function() {
        // Immer
        alert('Beendet!');
    });
});



    //Progressbar
    $('progressBug').click(function(e) {
        alert('a');
        var x = e.pageX - this.offsetLeft,
            y = e.pageY - this.offsetTop,
            clickedValue = x * this.max /this.offsetWidth;

            console.log(x, y, clickedValue);
            $('progressBug').val(clickedValue);
    }); 



























<html>
<head>
</head>
<body>

<form action="handler.php?act=createComment" method="POST">
    <input type="hidden" name="userID" value="1" />
    <input type="hidden" name="bugID" value="1" />
    <input type="hidden" name="content" value="test" />
    <input type="submit" value="test" />
</form>
</body>
</html>
