<?php
  // deutschsprachige Hauptseite der Heuschrecken

  // require_once "includes/db_inc.php";
  // require_once "oo/species.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>Checkliste der Heuschrecken</h1>
      <h3>(aktualisiert 14.04.2012)</h3>
      <p>
        Die vorliegende Checkliste basiert auf dem durch deutsche Namen ergänzten
        Verzeichnis von <span class="author">Detzel, P.</span> (2001): Verzeichnis
        der Langfühlerschrecken (Ensifera) und Kurzfühlerschrecken (Caelifera) Deutschlands.
        <i>Entomofauna Germanica</i>, 5: 63-90.
        Die Nomenklatur richtet sich nach
        <span class="author">A. Coray & A. W. Lehmann</span> (1998): Taxonomie der Heuschrecken Deutschlands (Orthoptera):
        Formale Aspekte der wissenschaftlichen Namen. <i>Articulata-Beiheft</i> 7: 63-152.
      </p><p>
        Neu hinzugekommen sind seitdem Platycleis (Tesselana) veyseli Koçak, 1984,
        die Vorwald & Landeck durch 1997 gesammelte Tiere in Brandenburg nachwiesen
        (<i>Articulata</i> 18 (1): 19-34) und <i>Acrotylus patruelis</i>
        (Herrich-Schäffer, 1838), die Pankratius 2003 auf dem Nürnberger
        Bahnhofsgelände fand (<i>Articulata</i> 19,1: 53-59).
        <i>Phaneroptera nana</i> (Fieber, 1853) wurde erstmals von Coray (2003)
        bei Weil am Rhein auf deutschem Gebiet fesstgestellt; <i>Articulata</i> 18 (2): 247–250.
        Später konnte Boczki (2007) ihre Ausbreitung bis in den nördlichen Oberrheingraben
        feststellen; <i>Articulata</i> 22 (2): 235-248. Boczki (2007) konnte auch
        <i>Oedaleus decorus</i> (Germar, 1826) für Deutschland sicher nachweisen;
        <i>Articulata</i> 22 (1): 63–75.
        </p><p>
        Ferner erschien es sinnvoll, die meist bereits in <span class="author">Harz</span>
        (1957): Die Geradflügler Mitteleuropas; Jena) gebräuchlichen Untergattungen
        in die Liste einzufügen, da einige von diesen von manchen Autoren als eigenständige
        Gattungen angesehen werden; siehe z.B. <span class="author">Storozhenko</span>
        (2002): Far Eastern Entomologist 113:  1–16),
        <span class="author">Massa & Fontana</span> (2011): Zootaxa 2837: 1–47).

      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<?php
    // Ebene 1 - Ordnung
    $theOrder = "Orthoptera - Heuschrecken ";
    // Ebene 2 - Unterordnung
    $theSubOrders = Species::getTaxonomyLevel($pdo, $lutSys, 4); // sind nur 2

    echo "<h1>".$theOrder."</h1>";
    echo "<div class='row'>";

    if (count($theSubOrders)>0) {
      foreach($theSubOrders as $soID => $so) {

        echo "  <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12' style='border-right: 1px solid #f0f0f0;'>";
        echo "    <h2>".$so[0]['name_sc']." - ".$so[0]['name_ge']."</h2>";
      //  echo "    <hr>";
        // Ebene 3 - Familien
        $theFamilies = Species::getTaxonomyWithinLevel($pdo, $lutSys, 5, "subOrderID", $soID);

        if (count($theFamilies)>0) {
            foreach($theFamilies as $fID => $f) {
              echo "<hr>";
              echo "<h3>".$f[0]['name_sc']." - ".$f[0]['name_ge']."</h3>";
              echo "<hr>";
              // Ebene 4 - Unterfamilien
              $theSubFamilies = Species::getTaxonomyWithinLevel($pdo, $lutSys, 6, "familyID", $fID);
              if (count($theSubFamilies)>0) {
                foreach($theSubFamilies as $sfID => $sf) {
                  echo "<h4>".$sf[0]['name_sc'];
                  echo (strlen($sf[0]['name_ge'])>0) ? " - ".$sf[0]['name_ge']."" : "";
                  echo "</h4>";

                  // Ebene 5 - Arten
                  // $theSpecies = Species::getTaxonomyWithinLevel($pdo, $lutSys, 7, "subFamilyID", $sfID);
                  $theSpecies = Species::getSpeciesInTaxonomyLevel($pdo, $tblSpecies, $lutSys, $sfID, "subFamilyID");
                  if (count($theSpecies)>0) {
                    for ($k=0; $k<count($theSpecies); $k++) {
                      $linkName = strtolower(str_replace(" ", "_", $theSpecies[$k]->name_sc));
                      if (strpos($linkName, "(")>0) {
                        $link = preg_replace('/\(.*?\)_|\s*/', '', $linkName);
                      } else {
                        $link = $linkName;
                      }

                      echo "<p><a href='./heuschrecken/arten/".$link."'><button type='button' class='btn btn-default btn-block'><i>".$theSpecies[$k]->name_sc."</i>";
                      echo (strlen($theSpecies[$k]->name_ge)>0) ? "<span class='speciessmallscr'> - ".$theSpecies[$k]->name_ge."</span>" : "";
                      echo " <br><small class='text-muted'>(".$theSpecies[$k]->nameOrigin.")</small>";
                      echo "</button></p></a>";
                      // echo "<p><i>".$theSpecies[$k]->name_sc."</i>";
                      // echo (strlen($theSpecies[$k]->name_ge)>0) ? " - ".$theSpecies[$k]->name_ge."" : "";
                      // echo " <br><small class='text-muted'>(".$theSpecies[$k]->nameOrigin.")</small>";
                      // echo "</p>";
                    }
                  }
                }
              }
            }
        }
        echo "  </div>";
      }
    }

    echo "</div>";


?>
    </div>
  </div>
</div>
