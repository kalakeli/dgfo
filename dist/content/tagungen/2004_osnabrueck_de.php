<?php
  // content/tagungen/2004_osnabrueck_de.php

  $dir = "images/picturegalerie/2004_osnabrueck/";

  // alle Dateien im Verzeichnis auslesen, statt des Asterisk koennten wir auch
  // .jpg schreiben, was besser und schneller wäre, aber die alten Bilder sind
  // wild durcheinander, also muss mind. fuer die alten Seiten der Umweg her
  $i = 1;
  $pics = array();
  foreach(glob($dir.'*') as $fn) {
    $bn = basename($fn);
    $theFront = substr($bn, 0, strripos($bn, "."));
    $theSuffix = substr($bn, strripos($bn, ".")-strlen($bn));

    if ( ($theSuffix === ".jpg") || ($theSuffix === ".png") ) {

      // kleine und grosse Versionen werden benutzt
      if ( (substr($theFront, -3) == "_sm") || (substr($theFront, -3) == "_lg") ) {
        $pics[] = $bn;
      }
    }

    // sortieren, damit die richtigen Namen uebereinander sind
    sort($pics);

  }
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h2>Bildergalerie Osnabrück 2004</h2>
      <p>
        Impressionen der Tagung in Osnabrück. Klicken Sie ein Bild an, um eine
        vergrößerte Version zu sehen.
      </p>
    </div>
  </div>

<?php
  if (count($pics) > 0) {
    echo "<div class='row'>";
    for ($i=1; $i<count($pics); $i=$i+2) {
      $theFront = substr($pics[$i], 0, strripos($pics[$i], "."));
      echo "  <div class='col-lg-2 col-md-2 col-sm-3 col-xs-6'>";
      if (substr($theFront, -3)=="_sm") {
        echo "<p>
            <a href='".$dir.$pics[$i-1]."' data-lightbox='tagung'>
              <img src='".$dir.$pics[$i]."' alt='Bild' class='img-responsive img-thumbnail'>
            </a>
          </p>";
      }
      echo "  </div>";
    }

    echo "</div>";
  } else {
    echo "<div class='row'>";
    echo "  <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
    echo "    <p class='alert alert-danger'>
                Es liegen keine Bilder von dieser Tagung vor!
              </p>";
    echo "  </div>";
    echo "</div>";
  }
?>
</div>
