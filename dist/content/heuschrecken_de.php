<?php
  // deutschsprachige Hauptseite der Heuschrecken

  // require_once "includes/db_inc.php";
  // require_once "oo/species.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>Heuschrecken und Fangschrecken</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h2>Heuschreckenfauna Europas</h2>
      <p>
        In Europa kommen aktuell über 1.000 Heuschreckenarten vor, von denen nach
        der aktuellen Europäischen Roten Liste mehr als ein Viertel als gefährdet
        eingestuft wird. Die mitteleuropäische Heuschreckenfauna umfasst lediglich
        etwas weniger als 160 Arten. In Deutschland und Nordtirol kommen derzeit
        85 Heuschreckenarten und eine Fangschreckenart vor, die in den letzen
        Jahren regelmäßig nachgewiesen werden konnten. Mehr als 40% der hierzulande
        nachgewiesenen Arten sind in ihrem Fortbestand bedroht. Die Hauptursache
        für den massiven Rückgang vieler in Deutschland ehemalig weit verbreiteten
        Heuschreckenarten ist der Landnutzungswandel. Gleichzeitig kann jedoch
        aktuell infolge anthropogen-bedingter klimatischer Veränderungen eine
        teils starke Ausbreitung thermophiler Arten beobachtet werden.
      </p>
      <p>
        Für weitere Informationen über das Vorkommen und die Verbreitung der
        Heuschrecken im gesamten Bearbeitungsgebiet der DGfO Nutzen Sie bitte
        die Quellen in unserer Literaturdatenbank.
      </p>

      <h2>Heuschreckenfauna Deutschlands</h2>
      <p>
        Die folgende Übersicht gibt Ihnen einen Überblick über alle aktuell in
        Deutschland nachgewiesenen Fang und Heuschreckenarten. Wissenschaftliche
        Artnamen unterliegen der Nomenklatur der internationalen Datenbanken
        aller weltweit vorkommenden Fang- und Heuschreckenarten
        (<a href="http://orthoptera.speciesfile.org" target="_blank"><em>Orthoptera Species File</em></a> bzw.
        <a href="http://mantodea.speciesfile.org" target="_blank"><em>Mantodea Species File</em></a>).
        Die Arten sind ihren Ordnungen, Familien und Unterfamilien nach geordnet.
        Innerhalb der Unterfamilien werden die Arten in alphabetischer Reihenfolge
        aufgeführt. Mit einem Klick auf die Arten erhalten Sie weitere
        Informationen zur Verbreitung und zum Gefährdungsstatus der Arten
        innerhalb Deutschlands.
      </p>


    </div>
    <!-- rechte Seite -->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <h2>Auch interessant</h2>
      <!-- Regionale Arbeitskreise -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Regionale Arbeitskreise</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <p>
                <a href="heuschrecken/arbeitskreise/nrw/">
                  <button type="button" name="button" class="btn btn-block btn-success">
                    AK Heuschrecken in NRW
                  </button>
                </a>
              </p>
              <p>
                <a href="heuschrecken/arbeitskreise/brandenburg/">
                  <button type="button" name="button" class="btn btn-block btn-success">
                    AK Heuschrecken in Brandenburg
                  </button>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <p>&nbsp;</p>
      <!-- Literatur -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Literatur</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <p>
                Hier finden Sie eine umfassende Übersicht zu den wichtigsten
                Literaturquellen über Fang- und Heuschrecken im Bearbeitungsgebiet
                der DGfO.
              </p>
              <p>
                <a href="heuschrecken/literatur/">
                  <button type="button" name="button" class="btn btn-block btn-success">
                    zur Literaturübersicht
                  </button>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
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

    echo "  </div>";
    echo "</div>";


?>
    </div>
  </div>
</div>
