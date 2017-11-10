<?php
  // deutschsprachige Hauptseite der Schaben und Ohrwürmer

  // require_once "includes/db_inc.php";
  // require_once "oo/species.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>Schaben und Ohrwürmer</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <p>
          Neben Heuschrecken und Fangschrecken interessieren wir uns auch für
          Schaben und Ohrwürmer. Die natürlichen Vorkommen der meisten Arten
          beider Taxa sind auf tropische Gebiete beschränkt. In Mitteleuropa
          sind die beiden Artengruppen folglich nur mit wenigen Arten vertreten.
          In Deutschland kommen aktuell 14 Schabenarten und 9 Ohrwurmarten vor,
          unter denen sechs Schabenarten und zwei Ohrwurmarten ausschließlich
          synathrop leben. Diese Arten wurden durch menschliche Tätigkeiten
          eingeschleppt. Sie überwintern hierzulande in beheizten Gebäuden
          (Schaben und Ohrwürmer) oder Mülldeponien (Ohrwürmer).
          Die nachfolgende Checkliste der in Deutschland lebenden Arten wurde
          von
          <script type="text/javascript">
          //<![CDATA[
          <!--
          var x="function f(x){var i,o=\"\",l=x.length;for(i=l-1;i>=0;i--) {try{o+=x.c" +
          "harAt(i);}catch(e){}}return o;}f(\")\\\"function f(x,y){var i,o=\\\"\\\\\\\""+
          "\\\\,l=x.length;for(i=0;i<l;i++){y%=127;o+=String.fromCharCode(x.charCodeAt" +
          "(i)^(y++));}return o;}f(\\\"\\\\37:/693*q\\\\\\\\027\\\\\\\\023\\\\\\\\013\\"+
          "\\\\\\027\\\\\\\\001\\\\\\\\t\\\\\\\\010OJU\\\\\\\\013K\\\\\\\\004\\\\\\\\0" +
          "37\\\\\\\\013\\\\\\\\tM-P\\\\\\\\036\\\\\\\\025\\\\\\\\034\\\\\\\\032\\\\\\" +
          "\\003\\\\\\\\027C\\\\\\\\022\\\\\\\\036\\\\\\\\t\\\\\\\\016\\\\\\\\035hsg`o" +
          "`h)zezKkbah|t\\\\\\\\177r}y8twtF9<iwkLD\\\\\\\\037\\\\\\\\177\\\\\\\\006y\\" +
          "\\\\\\004\\\\\\\\031eHDM^HJ\\\\\\\\017q]PRZ\\\\\\\\025fQ]P\\\\\\\\\\\\\\\\^" +
          "N\\\\\\\\001\\\\\\\\021^~ckxt~\\\"\\\\,87)\\\"(f};)lo,0(rtsbus.o nruter};)i" +
          "(tArahc.x=+o{)--i;0=>i;1-l=i(rof}}{)e(hctac};l=+l;x=+x{yrt{)39=!)31/l(tAedo" +
          "Crahc.x(elihw;lo=l,htgnel.x=lo,\\\"\\\"=o,i rav{)x(f noitcnuf\")"            ;
          while(x=eval(x));
          //-->
          //]]>
          </script>

          erstellt.
      </p>

    </div>
    <!-- rechte Seite -->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Ansprechpartner</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <p>
                Manfred Alban Pfeifer <br>
                Bahnhofsplatz 5 <br>
                67240 Bobenheim-Roxheim <br>
                Telefon: +49 6239-929515 </p><p>
                E-Mail:
                <script type="text/javascript">
                //<![CDATA[
                <!--
                var x="function f(x){var i,o=\"\",l=x.length;for(i=l-1;i>=0;i--) {try{o+=x.c" +
                "harAt(i);}catch(e){}}return o;}f(\")\\\"function f(x,y){var i,o=\\\"\\\\\\\""+
                "\\\\,l=x.length;for(i=0;i<l;i++){y%=127;o+=String.fromCharCode(x.charCodeAt" +
                "(i)^(y++));}return o;}f(\\\"\\\\37:/693*q\\\\\\\\027\\\\\\\\023\\\\\\\\013\\"+
                "\\\\\\027\\\\\\\\001\\\\\\\\t\\\\\\\\010OJU\\\\\\\\013K\\\\\\\\004\\\\\\\\0" +
                "37\\\\\\\\013\\\\\\\\tM-P\\\\\\\\036\\\\\\\\025\\\\\\\\034\\\\\\\\032\\\\\\" +
                "\\003\\\\\\\\027C\\\\\\\\022\\\\\\\\036\\\\\\\\t\\\\\\\\016\\\\\\\\035hsg`o" +
                "`h)zezKkbah|t\\\\\\\\177r}y8twtF9<iwkLD\\\\\\\\037\\\\\\\\177\\\\\\\\006y\\" +
                "\\\\\\004\\\\\\\\031eHDM^HJ\\\\\\\\017q]PRZ\\\\\\\\025fQ]P\\\\\\\\\\\\\\\\^" +
                "N\\\\\\\\001\\\\\\\\021^~ckxt~\\\"\\\\,87)\\\"(f};)lo,0(rtsbus.o nruter};)i" +
                "(tArahc.x=+o{)--i;0=>i;1-l=i(rof}}{)e(hctac};l=+l;x=+x{yrt{)39=!)31/l(tAedo" +
                "Crahc.x(elihw;lo=l,htgnel.x=lo,\\\"\\\"=o,i rav{)x(f noitcnuf\")"            ;
                while(x=eval(x));
                //-->
                //]]>
                </script>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
// +++++++++++++++++++++++++++++ S C H A B E N ++++++++++++++++++++++++++++++++
echo "<div class='row'>
        <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>";
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
        <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12'>";
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

      echo "<p><a href='./schaben/arten/".$link."'><button type='button' class='btn btn-default btn-block'><i>".$theSpecies[$i]->name_sc."</i>";
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


echo "  </div>";
echo "</div>";
?>
</div>
