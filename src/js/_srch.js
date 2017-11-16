// -----------------------------------------------------------------
// Articulata durchsuchen
// -----------------------------------------------------------------
$( "#srchArticulata" ).submit(function( event ) {

    var request;

    $( "#srchresult" ).removeClass("alert alert-danger");
    $( "#srchresult" ).removeClass("alert alert-success");

    // Abort any pending request
    if (request) { request.abort(); }

    // Fire off the request
    request = $.ajax({
        url: "redirects/redirect_search.php",
        method: "post",
        data: { srch: "ok", srchterm: $(' #id_srchterm').val() }
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){

        if (response.valueOf().substr(0,3)==="F -")
        {
    //        $( "#srchresult" ).addClass("alert alert-danger");
    //        $( "#srchresult" ).html("<h4>Ups ... </h4><p>"+response.valueOf().substr(3)+"</p> ");
            $( "#srchresult" ).html("<h3>Suchergebnisse</h3><p>Leider konnten keine Einträge für diese Suche gefunden werden</p> ");
    //        $( "#srchresult" ).fadeIn("slow");

        } else {
            // $( "#srchresult" ).addClass("alert alert-success");
            $( "#srchresult" ).html(response.valueOf());
            $( "#srchresult" ).fadeIn("slow");

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
        // nothing to do here
    });

    // Prevent default posting of form
    event.preventDefault();
});



// ----------------------------------------------------------------------------
// Art in Datenbank suchen
// - der String wird auf Serverseite geschrieben, was natuerlich
//   unguenstig in der Performance ist, aber einige Fallunterscheidungen spart
// ----------------------------------------------------------------------------
function getSpeciesByName(val) {

  var request;

  // Abort any pending request
  if (request) { request.abort(); }

  // Fire off the request to /form.php
  request = $.ajax({
      url: "redirects/redirect_search.php",
      method: "post",
      data: { getspecies: "ok", val: val}
  });

  // Callback handler that will be called on success
  request.done(function (response, textStatus, jqXHR){
      // inner = "";
      //
      // if (response.length>0) {
      //   if (response.indexOf(";")>0) {
      //     arr = response.split(";");
      //     inner = inner + "<ul class='ac'>";
      //     for (var i=0; i<arr.length; i++) {
      //       arrSrc = arr[i].split("|");
      //       inner = inner + "<li><a href='./art/"+arrSrc[0]+"'>"+arrSrc[1]+"</a></li>";
      //     }
      //     inner = inner + "</ul>";
      //   } else {
      //     inner = inner + "<ul class='ac'>";
      //     arrSrc = response.split("|");
      //     inner = inner + "<li><a href='./art/"+arrSrc[0]+"'>"+arrSrc[1]+"</a></li>";
      //     inner = inner + "</ul>";
      //   }
      // }

      $('#ac_choices').html(response.valueOf());
  });

  // Callback handler that will be called on failure
  request.fail(function (jqXHR, textStatus, errorThrown){
      console.error(
          "The following error occurred: " + textStatus, errorThrown
      );
  });

  // Callback handler called regardless in any case
  request.always(function () {
    // nothing to do ...
  });

}
