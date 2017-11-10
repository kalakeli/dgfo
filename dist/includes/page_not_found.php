<?php
  // Fehlerseite: page_not_found


    include_once "oo/species.php";
    include_once "oo/speciespics.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1 class="text-danger">Seite nicht gefunden!</h1>
      <h3 class="text-danger">
        Wir bitten um Entschuldigung, aber die Seite existiert nicht auf diesem Server! </h3>
      <p class="text-danger">
        Wenn Sie die Adresse selber eingegeben haben, prüfen Sie doch noch mal,
        ob Sie sich vertippt haben. Sollten Sie aber über einen Link auf unseren
        Seiten diese Fehlerseite sehen, dann wären wir sehr dankbar für eine
        E-Mail mit dem Link und vor allem der Seite, wo der fehlerhafte Link ist.
      </p>
      <p>
        <button type="button" name="zurück" class="btn btn-primary" onclick="window.history.go(-1);">
          zur letzten Seite
        </button>
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h3>
        Wo Sie schon mal hier sind, können wir Sie vielleicht mit einigen
        Artbildern begeistern?
      </h3>

    </div>
  </div>

<?php
  // Zufallsauswahl an Bildern lesen um sie anzuzeigen
  $nr = 8;
  $container = array();

  while (count($container)<$nr) {
    $thePic = SpeciesPic::getRandomPic($pdo, $tblSpeciesPics);
    if (strlen($thePic->spPKID)>0) {
      if (file_exists("images/species/".$thePic->pic)) {
        $in = false;
        for ($i=0; $i<count($container); $i++) {
          if ($container[$i]->spPKID == $thePic->spPKID) {
            $in = true;
          }
        }
        if (!$in) {
            $container[] = $thePic;
        }
      }
    }
  }

  // Bilder zusammenbauen und zurueckschicken
  $str = "";
  for ($i=0; $i<count($container); $i++) {
    $theSpecies = Species::getSpeciesById($pdo, $tblSpecies, $lutSys, $container[$i]->speciesID);
    $linkName = strtolower(str_replace(" ", "_", $theSpecies->name_sc));
    if (strpos($linkName, "(")>0) {
      $link = preg_replace('/\(.*?\)_|\s*/', '', $linkName);
    } else {
      $link = $linkName;
    }
    if (bcmod("".$i."", "4")==0) {
      $str .= "</div><div class='row'>";
    }
    $str .= "<div class='col-md-3 col-sm-3'><p>";
    $str .= "  <a href='./heuschrecken/arten/".$link."' title='mehr Infos gibt es, wenn Sie das Bild anklicken'><img src='images/species/".str_ireplace('_lg.jpg', '_mi.jpg', $container[$i]->pic)."' alt='bild' class='img-rounded img-responsive'></a>";
    $str .= "  <div class='imgtitle'>";
    $str .= "    <p><em>".$container[$i]->picText."</em></p>";
    $str .= "  </div>";
    $str .= "</p></div>";
  }
  echo "<div class='row'>".$str."</div>";
?>

</div>
