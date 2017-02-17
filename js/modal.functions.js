$('#form_create_comment').submit(function(event) {
    // Das eigentliche Absenden verhindern
    event.preventDefault();
          
    // Der eigentliche AJAX Aufruf
    $.ajax({
        url : 'handler.php?act=createComment',
        type : 'POST',
        data : {
            userID : $('#userID').val(),
            bugID : $('#bugID').val(),
            content : $('#comment').val()
        }
    }).success(function (xhr) {
        // Bei Erfolg
        notify('Comment saved', 2);
        $('#comments').append(xhr);
    }).fail(function() {
        // Bei Fehler
        notify('Comment could not be Saved!', 3);
    }).always(function() {
        // Immer
        //alert('Beendet!');
    });
});



$('#form_edit_status').change(function(event) {
    $.ajax({
        url : 'handler.php?act=changeStatus',
        type : 'POST',
        data : {            
            bugID : $('#modalShowBug').attr('data-id'),
            statusID : $("#new_status").val()
        }
   }).success(function (xhr) {
        //Bei Erfolg        
        //alert("reload bugList");
        //Bugs neu laden:
        $('#buglist').load('handler.php?act=get_buglist&page=' + window.location.hash.replace('#page=', ''));
        notify('Status saved', 2);                    
    }).fail(function() {
        // Bei Fehler
        notify('Status could not be Saved!', 3);
    }).always(function() {
        // Immer
        //alert('Beendet!');
    });
});



$('#form_edit_assigned_to').change(function(event) {
    $.ajax({
        url : 'handler.php?act=changeAssignedToUser',
        type : 'POST',
        data : {            
            bugID : $('#modalShowBug').attr('data-id'),
            userID : $("#assignedToUser").val()
        }
   }).success(function (xhr) {
        //Bei Erfolg        
        //alert("reload bugList");
        //Bugs neu laden:
        $('#buglist').load('handler.php?act=get_buglist&page=' + window.location.hash.replace('#page=', ''));
        notify('AssignedToUser saved', 2);                    
    }).fail(function() {
        // Bei Fehler
        notify('AssignedToUser could not be Saved!', 3);
    }).always(function() {
        // Immer
        //alert('Beendet!');
    });
});

$('#form_edit_progress').submit(function(event) {
    event.preventDefault();

    $.ajax({
        url : 'handler.php?act=changeProgress',
        type : 'POST',
        data : {            
            bugID : $('#modalShowBug').attr('data-id'),
            new_progress : $("#new_progress").val()
        }
   }).success(function (xhr) {
        //Bei Erfolg        
        //ProgressbarValue anpassen
        $(".progress-bar").text($("#new_progress").val() + "%");
        $(".progress-bar").removeClass("progress-bar-danger");
        $(".progress-bar").removeClass("progress-bar-warning");
        $(".progress-bar").removeClass("progress-bar-success");
        $(".progress-bar").attr('aria-valuenow', $("#new_progress").val());
        $(".progress-bar").width($("#new_progress").val() + "%");
        
        if($("#new_progress").val() <= 33) 
        {
            $(".progress-bar").addClass("progress-bar-danger");
        }
        else if ($("#new_progress").val() > 33 && $("#new_progress").val() <= 66)
        {
            $(".progress-bar").addClass("progress-bar-warning");
        }
        else 
        {
            $(".progress-bar").addClass("progress-bar-success");
        }

        notify('Progress saved', 2);
    }).fail(function() {
        // Bei Fehler
        notify('Progress could not be Saved!', 3);
    }).always(function() {
        // Immer
        //alert('Beendet!');
    });

});

