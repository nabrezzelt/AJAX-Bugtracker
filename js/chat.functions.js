/*
* ##################
* # Chat Functions #
* ##################
*/



function getConversation(userID) {
    $.ajax({
        url : 'handler.php?act=getConversation',
        type : 'POST',
        data : {                        
            userID : userID
        }
   }).success(function (xhr) {
        console.log(xhr);
        $('.conversations').append(xhr);
        notify('Conversation loaded', 2);                    
    }).fail(function() {
        // Bei Fehler
        notify('Conversation could not be loaded!', 3);
    }).always(function() {
        // Immer
        //alert('Beendet!');
    });
}






/*
* ##################
* #  Chat Events   #
* ##################
*/

$('.inputbox').keypress(function(e){ 
    if (e.which == 13) 
    { 
        alert('Es wurde ENTER gedrückt');
    } 
});

   

$('.getConversation').click(function() {
    getConversation($(this).data('account-id'));
});