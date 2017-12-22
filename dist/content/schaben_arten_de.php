<?php
  // deutschsprachige Schaben-/Ohrwuermerseite der dgfo
  include_once "oo/species.php";
  include_once "oo/speciesinfo.php";
  include_once "oo/speciespics.php";
?>

<div class="container-fluid">



<?php
  if (empty($_GET["level2"])) {

      echo "<div class='row'>";
      echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";

      echo "    <div class='row'>";


      echo "      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12' style='border-right: 1px solid #f0f0f0;'>";
      // Ebene 1 - Ordnung
      $theOrder = "Blattodea - Schaben ";

      $theSpecies = Species::getWildlivingSpecies($pdo, $tblSpecies, 12);

      echo "<h1>".$theOrder."<br><small>im Freiland lebende Arten</small></h1>";

      if (count($theSpecies)>0) {
        $fam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[0]->familyID);
        $famID = $theSpecies[0]->familyID;
        $subFam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[0]->subFamilyID);
        $subFamID = $theSpecies[0]->subFamilyID;
        echo "<h3>".$fam_sc."</h3>";
        echo "<h4>".$subFam_sc."</h4>";
        for ($i=0; $i<count($theSpecies); $i++) {

            if ($theSpecies[$i]->familyID!=$famID) {
              $fam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[$i]->familyID);
              $famID = $theSpecies[$i]->familyID;
              echo "<h3>".$fam_sc."</h3>";
            }
            if ($theSpecies[$i]->subFamilyID!=$subFamID) {
              $subFam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[$i]->subFamilyID);
              $subFamID = $theSpecies[$i]->subFamilyID;
              echo "<h4>".$subFam_sc."</h4>";
            }

            $linkName = strtolower(str_replace(" ", "_", $theSpecies[$i]->name_sc));
            if (strpos($linkName, "(")>0) {
              $link = preg_replace('/\(.*?\)_|\s*/', '', $linkName);
            } else {
              $link = $linkName;
            }

            echo "<p><a href='./schaben/arten/".$link."'><button type='button' class='btn btn-default btn-block'><i>".$theSpecies[$i]->name_sc."</i>";
            echo (strlen($theSpecies[$i]->name_ge)>0) ? "<span class='speciessmallscr'> - ".$theSpecies[$i]->name_ge."</span>" : "";
            echo " <br><small class='text-muted'>(".$theSpecies[$i]->nameOrigin.")</small>";
            echo "</button></p></a>";
        }
      }
      echo "      </div>";
      echo "      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>";

      $theSpecies = Species::getSynanthropeSpecies($pdo, $tblSpecies, 12);
      echo "<h1>".$theOrder."<br><small>Synanthrop lebende Arten</small></h1>";

      if (count($theSpecies)>0) {
        $fam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[0]->familyID);
        $famID = $theSpecies[0]->familyID;
        $subFam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[0]->subFamilyID);
        $subFamID = $theSpecies[0]->subFamilyID;
        echo "<h3>".$fam_sc."</h3>";
        echo "<h4>".$subFam_sc."</h4>";
        for ($i=0; $i<count($theSpecies); $i++) {

            if ($theSpecies[$i]->familyID!=$famID) {
              $fam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[$i]->familyID);
              $famID = $theSpecies[$i]->familyID;
              echo "<h3>".$fam_sc."</h3>";
            }
            if ($theSpecies[$i]->subFamilyID!=$subFamID) {
              $subFam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[$i]->subFamilyID);
              $subFamID = $theSpecies[$i]->subFamilyID;
              echo "<h4>".$subFam_sc."</h4>";
            }

            $linkName = strtolower(str_replace(" ", "_", $theSpecies[$i]->name_sc));
            if (strpos($linkName, "(")>0) {
              $link = preg_replace('/\(.*?\)_|\s*/', '', $linkName);
            } else {
              $link = $linkName;
            }

            echo "<p><a href='./schaben/arten/".$link."'><button type='button' class='btn btn-default btn-block'><i>".$theSpecies[$i]->name_sc."</i>";
            echo (strlen($theSpecies[$i]->name_ge)>0) ? "<span class='speciessmallscr'> - ".$theSpecies[$i]->name_ge."</span>" : "";
            echo " <br><small class='text-muted'>(".$theSpecies[$i]->nameOrigin.")</small>";
            echo "</button></p></a>";
        }
      }


      echo "  </div>";
      echo "</div>";


      echo "  </div>";
      echo "</div>";

      echo "<hr>";
      // +++++++++++++++++++++++++++++ O H R W U E R M E R  +++++++++++++++++++++++++


      echo "<div class='row'>
              <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
      echo "    <div class='row'>";


      echo "      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12' style='border-right: 1px solid #f0f0f0;'>";
      // Ebene 1 - Ordnung
      $theOrder = "Dermaptera - Ohrwürmer ";

      $theSpecies = Species::getWildlivingSpecies($pdo, $tblSpecies, 13);

      echo "<h1>".$theOrder."<br><small>im Freiland lebende Arten</small></h1>";

      if (count($theSpecies)>0) {
        $fam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[0]->familyID);
        $famID = $theSpecies[0]->familyID;
        $subFam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[0]->subFamilyID);
        $subFamID = $theSpecies[0]->subFamilyID;
        echo "<h3>".$fam_sc."</h3>";
        echo "<h4>".$subFam_sc."</h4>";
        for ($i=0; $i<count($theSpecies); $i++) {

            if ($theSpecies[$i]->familyID!=$famID) {
              $fam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[$i]->familyID);
              $famID = $theSpecies[$i]->familyID;
              echo "<h3>".$fam_sc."</h3>";
            }
            if ($theSpecies[$i]->subFamilyID!=$subFamID) {
              $subFam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[$i]->subFamilyID);
              $subFamID = $theSpecies[$i]->subFamilyID;
              echo "<h4>".$subFam_sc."</h4>";
            }

            $linkName = strtolower(str_replace(" ", "_", $theSpecies[$i]->name_sc));
            if (strpos($linkName, "(")>0) {
              $link = preg_replace('/\(.*?\)_|\s*/', '', $linkName);
            } else {
              $link = $linkName;
            }

            echo "<p><a href='schaben/arten/".$link."'><button type='button' class='btn btn-default btn-block'><i>".$theSpecies[$i]->name_sc."</i>";
            echo (strlen($theSpecies[$i]->name_ge)>0) ? "<span class='speciessmallscr'> - ".$theSpecies[$i]->name_ge."</span>" : "";
            echo " <br><small class='text-muted'>(".$theSpecies[$i]->nameOrigin.")</small>";
            echo "</button></p></a>";
        }
      }
      echo "      </div>";
      echo "      <div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>";

      $theSpecies = Species::getSynanthropeSpecies($pdo, $tblSpecies, 13);
      echo "<h1>".$theOrder."<br><small>Synanthrop lebende Arten</small></h1>";

      if (count($theSpecies)>0) {
        $fam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[0]->familyID);
        $famID = $theSpecies[0]->familyID;
        $subFam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[0]->subFamilyID);
        $subFamID = $theSpecies[0]->subFamilyID;
        echo "<h3>".$fam_sc."</h3>";
        echo "<h4>".$subFam_sc."</h4>";
        for ($i=0; $i<count($theSpecies); $i++) {

            if ($theSpecies[$i]->familyID!=$famID) {
              $fam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[$i]->familyID);
              $famID = $theSpecies[$i]->familyID;
              echo "<h3>".$fam_sc."</h3>";
            }
            if ($theSpecies[$i]->subFamilyID!=$subFamID) {
              $subFam_sc = Species::getTaxonomyValForId($pdo, $lutSys, $theSpecies[$i]->subFamilyID);
              $subFamID = $theSpecies[$i]->subFamilyID;
              echo "<h4>".$subFam_sc."</h4>";
            }

            $linkName = strtolower(str_replace(" ", "_", $theSpecies[$i]->name_sc));
            if (strpos($linkName, "(")>0) {
              $link = preg_replace('/\(.*?\)_|\s*/', '', $linkName);
            } else {
              $link = $linkName;
            }

            echo "<p><a href='./schaben/arten/".$link."'><button type='button' class='btn btn-default btn-block'><i>".$theSpecies[$i]->name_sc."</i>";
            echo (strlen($theSpecies[$i]->name_ge)>0) ? "<span class='speciessmallscr'> - ".$theSpecies[$i]->name_ge."</span>" : "";
            echo " <br><small class='text-muted'>(".$theSpecies[$i]->nameOrigin.")</small>";
            echo "</button></p></a>";
        }
      }


      echo "  </div>";
      echo "</div>";

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
        echo "  <div class='col-lg-9 col-md-9 col-sm-9 col-xs-12'>";
        echo "   <h2 id='id_spname_ge'>".$theSpecies->name_ge." <span id='id_spname_sc'><em>(".$theSpecies->name_sc.")</em></span></h2>";
        echo "  </div>";
        echo "  <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12'>";
        $nameOrigin = (strlen($theSpecies->nameOrigin)>0) ? " (".$theSpecies->nameOrigin.") " : "";
        echo "   <h2><small class='text-muted' id='id_spname_origin'>".$nameOrigin."</small></h2>";
        echo "  </div>";
        // echo "  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12'>";
        // echo "   <h2 class='text-right' id='id_spname_en'>".$theSpecies->name_en."</h2>";
        // echo "  </div>";
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
        // echo "    <p id='id_sp_osfid'>";
        // echo (strlen($theInfo->osfID)>0)
        //   ? "<a href='http://orthoptera.speciesfile.org/Common/basic/Taxa.aspx?TaxonNameID=".$theInfo->osfID."' target='_blank'><button type='button' name='osf' class='btn btn-block btn-success'>OSF-ID</button></a>"
        //   : "<button type='button' name='osf' class='btn btn-block btn-success' disabled>OSF-ID</button>";
        // echo "   </p>";
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
