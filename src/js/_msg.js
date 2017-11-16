// -----------------------------------------------------------------
// Articulata durchsuchen
// -----------------------------------------------------------------
$( "#fMail" ).submit(function( event ) {

    var request;

    $( "#msg" ).removeClass("alert alert-danger");
    $( "#msg" ).removeClass("alert alert-success");

    // var name = $('#inputName').val();
    // var email = $('#inputEmail').val();
    // var addr = $('#inputAddr').val();
    // var topic = $('#inputSubject').val();
    // var text = $('#inputMsg').val();
    // var target = $('#selTarget option:selected').val();

    // Abort any pending request
    if (request) { request.abort(); }

    // Fire off the request
    request = $.ajax({
        url: "redirects/redirect_misc.php",
        method: "post",
        data: { sendmessage: "ok",
                name: $('#inputName').val(),
                email: $('#inputEmail').val(),
                addr: $('#inputAddr').val(),
                topic: $('#inputSubject').val(),
                target: $('#selTarget option:selected').val(),
                msg: $('#inputMsg').val()
               }
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){

        if (response.valueOf().substr(0,3)==="F -")
        {
            $( "#msg" ).addClass("alert alert-danger");
            $( "#msg" ).html("<h3>Fehler</h3><p>Leider konnte die Nachricht nicht verschickt werden!</p> ");
            $( "#msg" ).fadeIn("slow");

        } else {
            $( "#msg" ).addClass("alert alert-success");
            $( "#msg" ).html(response.valueOf());
            $( "#msg" ).fadeIn("slow");

        }
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "The following error occurred: " + textStatus, errorThrown
        );
    });

    // Prevent default posting of form
    event.preventDefault();
});
