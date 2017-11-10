<?php
  // deutschsprachige Hauptseite der dgfo
  include_once "oo/species.php";
  include_once "oo/speciesinfo.php";
  include_once "oo/speciespics.php";
?>

<div class="container-fluid">


  <!-- <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
      <h1>Arten und Karten</h1>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <p>
        <label for="suche" class="control-label">Suche</label><br>
        <input type="text" class="form-control" name="srch" id="acsrch" value="" placeholder="Artname (syst., de., en.)">
      </p>
    </div>
  </div> -->

<?php
  if (empty($_GET["level2"])) {

      echo "<div class='row'>";
      echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";

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

      echo "<div class='row'>
              <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";

      // Ebene 1 - Ordnung
      $theOrder = "Mantodea - Fangschrecken ";
      // Ebene 2 - Unterordnung -> keine bei Mantodea

      echo "<h1>".$theOrder."</h1>";
      echo "<div class='row'>";
      echo "  <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12' style='border-right: 1px solid #f0f0f0;'>";
      echo "<hr>";
      echo "<h3>Mantidae - Gottesanbeterinnen</h3>";
      echo "<hr>";
      // Ebene 4 - Unterfamilien
      echo "<h4>Mantinae - Gottesanbeterinnen</h4>";

      // Ebene 5 - Arten
      $theSpecies = Species::getSpeciesInTaxonomyLevel($pdo, $tblSpecies, $lutSys, 3000, "subFamilyID");
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

        }
      }

      echo "      </div>";
      echo "    </div>";

      echo "  </div>";
      echo "</div>";


  } else {  // Artinfos lesen ...


    // Art bestimmen
    $theName = str_replace("_", "%", $_GET["level2"]);
    $foundSpecies = Species::getSpeciesByName($pdo, $tblSpecies, $lutSys, $theName);

    if (count($foundSpecies)>0) {

      $theSpecies = $foundSpecies[0];

      if ($theSpecies->speciesPKID > 0) {
        $theInfo = SpeciesInfo::getInfoBySpeciesId($pdo, $tblSpeciesInfo, $theSpecies->speciesPKID);
        $thePics = SpeciesPic::getPicsBySpeciesId($pdo, $tblSpeciesPics, $theSpecies->speciesPKID);

        // Zeile mit Namen
        echo "<div class='row'>";
        echo "  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>";
        echo "   <h2 id='id_spname_ge'>".$theSpecies->name_ge."</h2>";
        echo "  </div>";
        echo "  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>";
        $nameOrigin = (strlen($theSpecies->nameOrigin)>0) ? " (".$theSpecies->nameOrigin.") " : "";
        echo "   <h2 id='id_spname_sc'><em>".$theSpecies->name_sc."</em>
                 <br><small class='text-muted' id='id_spname_origin'>".$nameOrigin."</small></h2>";
        echo "  </div>";
        echo "  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>";
        echo "   <h2 class='text-right' id='id_spname_en'>".$theSpecies->name_en."</h2>";
        echo "  </div>";
        echo "</div>";

        // Zeile mit Bild, verlinkten IDs, Karte

        echo "<div class='row'>";
        echo "  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-6'>"; // Bilder (m, w)
        if (count($thePics)>0) {
          $path = "images/species/";
          for ($i=0; $i<count($thePics); $i++) {
            $pic = $path.$thePics[$i]->pic;
            if (file_exists($pic)) {
              $owner = (strlen($thePics[$i]->picSrc)>0) ? "© ".$thePics[$i]->picSrc : " unbekannt ";
              echo "   <figure>";
              echo "      <img src='".$pic."' class='img-rounded img-responsive' alt='speciespic'>";
              echo "      <figcaption id='id_sp_piccaption'>".$thePics[$i]->picText."<br>".$owner."</figcaption";
              echo "   </figure>";
            }
          }
        } else {
          echo "<div style='width:100%;height:auto;min-height:150px;background-color:#eaeaea;border:1px solid #e0e0e0; border-radius:6px; padding:20px;'>";
          echo "<p>Uns liegt kein Bild dieser Art vor. <br>Wenn Sie eines haben, freuen wir uns sehr über eine Kontaktaufnahme!</p>";
          echo "</div>";
        }

        echo "  </div>";
        echo "  <div class='col-lg-2 col-md-2 col-sm-2 col-xs-6'>"; // IDs
        echo "    <p id='id_sp_osfid'>";
        echo (strlen($theInfo->osfID)>0)
          ? "<a href='http://orthoptera.speciesfile.org/Common/basic/Taxa.aspx?TaxonNameID=".$theInfo->osfID."' target='_blank'><button type='button' name='osf' class='btn btn-block btn-success'>OSF-ID</button></a>"
          : "<button type='button' name='osf' class='btn btn-block btn-success' disabled>OSF-ID</button>";
        echo "   </p>";
        echo "    <p id='id_sp_gbifid'>";
        echo (strlen($theInfo->gbifID)>0)
          ? "<a href='http://www.gbif.org/species/".$theInfo->gbifID."' target='_blank'><button type='button' name='osf' class='btn btn-block btn-success'>GBIF-ID</button></a>"
          : "<button type='button' name='osf' class='btn btn-block btn-success' disabled>GBIF-ID</button>";
        echo "   </p>";
        echo "    <p id='id_sp_systax'>";
        $title = "Database System for Systematics and Taxonomy";
        echo (strlen($theInfo->systaxID)>0)
          ? "<a href='http://www.biologie.uni-ulm.de/cgi-bin/query_all/details.pl?id=".$theInfo->systaxID."&stufe=7&typ=ZOO&sid=T&lang=e&pr=nix' target='_blank'><button type='button' name='osf' title='".$title."' class='btn btn-block btn-success'>SYSTAX</button></a>"
          : "<button type='button' name='osf' class='btn btn-block btn-success' title='".$title."' disabled>SYSTAX</button>";
        echo "   </p>";
        echo "  </div>";
        echo "  <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12' id='id_sp_map'>"; // Karte
        if (strlen($theInfo->mapPath)>0) {
          $path = "images/maps/".$theInfo->mapPath;
          if (file_exists($path)) {
            $owner = (strlen($theInfo->mapSrc)>0) ? " (Quelle: ".$theInfo->mapSrc.")" : " (Quelle: unbekannt) ";
            echo "   <figure class='pull-right'>";
            echo "      <img src='".$path."' class='img-thumbnail img-responsive' alt='speciesmap'>";
            echo "      <figcaption id='id_sp_mapcaption'>".$theInfo->mapInfo."<br>".$owner."</figcaption";
            echo "   </figure>";
          }
        } else {
          if (strlen($theInfo->mapSrc)>0) {
            echo "<h3>".$theInfo->mapInfo."</h3><p class='alert alert-warning'>".$theInfo->mapSrc."</p>";
          }
        }

        echo "  </div>";

        echo "</div>";
      }
      
    } else { // Art doch nicht gefunden
      echo "<div class='row'>";
      echo "  <div class='col-lg-6 col-md-6 col-sm-4 col-xs-12 alert alert-danger'>";
      echo "   <h2>Die Art konnte nicht abgerufen werden!</h2>
                  <p>Das kann verschiedene Ursachen haben, vielleicht ist einfach
                  die Verbindung zur Datenbank unterbrochen. Versuchen Sie es bitte
                  erneut. </p><p>Sollte der Fehler weiterhin bestehen, schicken Sie uns
                  bitte eine Nachricht, damit wir den Fehler beheben können.</p>";
      echo "  </div>";
      echo "</div>";
    }
  }
?>



</div>
