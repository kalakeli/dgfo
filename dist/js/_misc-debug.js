// -----------------------------------------------------------------
// // Zufallsbilder fuer den Kopfbereich laden
// -----------------------------------------------------------------
function loadRandomPics(target, nr) {

    var request;

    $( "#"+target+"" ).removeClass("alert alert-danger");

    // Abort any pending request
    if (request) { request.abort(); }

    // Fire off the request to /form.php
    request = $.ajax({
        url: "redirects/redirect_search.php",
        method: "post",
        data: {
          do: "loadRandomPics",
          nr: nr
        }
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){


        if (response.valueOf().substr(0,3)==="F -")
        {
            $( "#"+target+"" ).addClass("alert alert-danger");
            $( "#"+target+"" ).html("<h4>Ups ... </h4><p>"+response.valueOf().substr(3)+"</p> ");
            $( "#"+target+"" ).fadeIn("slow");

        } else {
          // Bilder anzeigen
          $( "#"+target+"" ).html(response.valueOf());
        }
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        console.error(
            "The following error occurred: " + textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // nope to do
    });


}
