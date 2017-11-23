<?php
  // deutschsprachige Hauptseite der dgfo
  include_once "oo/species.php";
  include_once "oo/speciesinfo.php";
  include_once "oo/speciespics.php";
?>

<div class="container-fluid">




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

    echo "<div class='row'>";
    echo "<div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>";
    echo "<h1>Informationen zur Art</h1>";
    echo "</div>";
    echo "<div class='col-lg-3 col-md-3 col-sm-12 col-xs-12'>";
    include_once "includes/snippet_search.php";
    echo "</div>";
    echo "</div>";

    echo "<div class='row'>";
    echo "<div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>";

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
        echo "  <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>";
        echo "   <h2 id='id_spname_ge'>".$theSpecies->name_ge."</h2>";
        echo "  </div>";
        echo "  <div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>";
        $nameOrigin = (strlen($theSpecies->nameOrigin)>0) ? " (".$theSpecies->nameOrigin.") " : "";
        echo "   <h2 id='id_spname_sc' class='text-right'><em>".$theSpecies->name_sc."</em>
                 <br><small class='text-muted' id='id_spname_origin'>".$nameOrigin."</small></h2>";
        echo "  </div>";

        echo "</div>";

        // Zeile mit Bild, verlinkten IDs, Karte

        echo "<div class='row'>";
        echo "  <div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>"; // Bilder (m, w)
        if (count($thePics)>0) {
          $path = "images/species/";
          $svgShown = false;
          for ($i=0; $i<count($thePics); $i++) {
            $pic = $path.$thePics[$i]->pic;
            if (file_exists($pic)) {
              $owner = (strlen($thePics[$i]->picSrc)>0) ? "© ".$thePics[$i]->picSrc : " unbekannt ";
              echo "   <figure>";
              $pic_xl = str_ireplace("_lg.", "_xl.", $pic);
              if (file_exists($pic_xl)) {
                echo "<a href='".$pic."' data-lightbox='Artbild' data-title='".$thePics[$i]->picText."<br>".$owner."'>";
                echo "      <img src='".$pic."' class='img-rounded img-responsive' alt='speciespic'>";
                echo "</a>";
              } else {
                echo "      <img src='".$pic."' class='img-rounded img-responsive' alt='speciespic'>";
              }

              echo "      <figcaption id='id_sp_piccaption'>".$thePics[$i]->picText."<br>".$owner."</figcaption";
              echo "   </figure>";
            } else { // wenn Bilder eingetragen sind, aber (noch) nicht gefunden werden, Dummy anzeigen
              if (!$svgShown) {
                echo "   <figure>";
                echo "<img src='images/svg_grasshopper.svg' class='img-rounded img-responsive' alt='kein Artbild'>";
                echo "<figcaption>Leider liegt uns derzeit noch kein Bild dieser Art vor. Wenn Sie uns ein geeignetes Bild zur Verfügung stellen können, freuen wir uns sehr über eine Kontaktaufnahme</figcaption>";
                echo "   </figure>";
                $svgShown = true;
              }
            }
          }
        } else {
          echo "   <figure>";
          echo "<img src='images/svg_grasshopper.svg' class='img-rounded img-responsive' alt='kein Artbild'>";
          echo "<figcaption>Leider liegt uns derzeit noch kein Bild dieser Art vor. Wenn Sie uns ein geeignetes Bild zur Verfügung stellen können, freuen wir uns sehr über eine Kontaktaufnahme</figcaption>";
          echo "   </figure>";
        }

        echo "  </div>";
        echo "  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-12' id='id_sp_map'>"; // Karte
        if (strlen($theInfo->mapPath)>0) {
          $path = "images/maps/".$theInfo->mapPath;
          if (file_exists($path)) {
            $owner = (strlen($theInfo->mapSrc)>0) ? " (Quelle: ".$theInfo->mapSrc.")" : " (Quelle: unbekannt) ";
            echo "   <figure class='pull-right'>";
            echo "<a href='".$path."' data-lightbox='Karte' data-title='".$theInfo->mapInfo."<br>".$owner."'>";
            echo "      <img src='".$path."' class='img-thumbnail img-responsive' alt='speciesmap'>";
            echo "</a>";
            echo "      <figcaption id='id_sp_mapcaption'>".$theInfo->mapInfo."<br>".$owner."</figcaption";
            echo "   </figure>";
          }
        } else {
          if (strlen($theInfo->mapSrc)>0) {
            echo "<h3>".$theInfo->mapInfo."</h3><p class='alert alert-warning'>".$theInfo->mapSrc."</p>";
          }
        }
        echo "  </div>";
        echo "  <div class='col-lg-4 col-md-4 col-sm-4 col-xs-6'>"; // IDs
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

    // Ende der linken Spalten
    echo "  </div>";
    echo "  <div class='col-lg-3 col-md-3 col-sm-3 col-xs-12'>";
    echo "    <h2></h2>";
?>
<!-- Regionale Arbeitskreise -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">REGIONALE ARBEITSKREISE</h3>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <p>
          <ul class="dgfo">
  <li>
              <a href="heuschrecken/arbeitskreise/nrw/">
            Arbeitskreis Heuschrecken NRW</li></ul>

          </a>
        </p>
        <p>
           <ul class="dgfo">
              <li><a href="heuschrecken/arbeitskreise/brandenburg/">
          Arbeitskreis Heuschrecken Berlin-Brandenburg
            </li></ul>
          </a>
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Literatur -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h2 class="panel-title">LITERATUR</h2>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <p>
           <ul class="dgfo">
  <li><a href="heuschrecken/literatur/">

              Heuschreckenliteratur
            </li>
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">KONTAKT | HEUSCHRECKEN</h3>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-12 col-xs-12">
       <h4><p>Deutsche Gesellschaft für Orthopterologie</p><p>Prof. Dr. Thomas Fartmann</p></h4>
           <p>

c/o Universität Osnabrück<br>
Abteilung für Biodiversität und Landschaftsökologie<br>
Barbarastraße 11 <br>
          DE-49076 Osnabrück
        </p>
        <p>
          <strong>E-Mail:</strong> <script type="text/javascript">
  //<![CDATA[
  <!--
  var x="function f(x){var i,o=\"\",ol=x.length,l=ol;while(x.charCodeAt(l/13)!" +
  "=55){try{x+=x;l+=l;}catch(e){}}for(i=l-1;i>=0;i--){o+=x.charAt(i);}return o" +
  ".substr(0,ol);}f(\")221,\\\"meozpo1`r((e9&=700\\\\(+%.63!Y020\\\\I200\\\\13" +
  "0\\\\f330\\\\dn\\\\SY@ZF120\\\\220\\\\sKI200\\\\XE\\\\\\\\hIHDIWP@F1j'sovpy" +
  "z4I)uwcx/o1.#demsows-voe320\\\\010\\\\730\\\\420\\\\630\\\\\\\"(f};o nruter" +
  "};))++y(^)i(tAedoCrahc.x(edoCrahCmorf.gnirtS=+o;721=%y;i=+y)221==i(fi{)++i;" +
  "l<i;0=i(rof;htgnel.x=l,\\\"\\\"=o,i rav{)y,x(f noitcnuf\")"                  ;
  while(x=eval(x));
  //-->
  //]]>
  </script>
        </p>


      </div>
    </div>
  </div>
</div>
<?php
    echo "  </div>";
    echo "</div>";
  }
?>



</div>
