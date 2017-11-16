<?php
  // includes/snippet_search.php
  // die Suche, die auf den Seiten oben eingeblendet wird


// SUCHE EINBLENDEN
$ph = ($lang == "en") ? "search species" : "Art suchen (sc / de / en)";
echo "<small><br>";
echo "
        <input type='text' class='form-control' id='id_ac_s' name='getlist' placeholder='".$ph."' autocomplete='off'>
        <span id='indicator1' style='>
          <img src='images/loading.gif' alt='suche...'>
        </span>
        <div id='ac_choices' class='autocomplete'></div>
      ";
echo "</small>";

?>
