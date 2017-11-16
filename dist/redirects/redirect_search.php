<?php
    // - redirects/redirect_search.php
    // SUCHE


    require_once "includes/db_inc.php";
    require_once "oo/species.php";
    require_once "oo/speciespics.php";
    require_once "oo/publication.php";


  // establish connection to db
  if (empty($pdo)) {
    $dsn = "mysql:host=$host;dbname=$databaseName;charset=utf8";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $opt);
  }

  // falsch hier ...
  if ( (empty($_POST)) && (empty($_GET)) ) {
      header("Location: ./../index.php"); exit;
  }



  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //+++++  Suche
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  if ( (!empty($_POST['srch'])) && ("ok" === $_POST['srch']) ) {

    $snippet = strip_tags(trim($_POST['srchterm']));
    $theArticles = Publication::searchPubs($pdo, $tblPub, $snippet, "%%");

    $str = "";
    if (count($theArticles)>0) {
      $str .= "<div class='row'>";
      $str .= "  <div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>";
      $str .= "    <h3>Suchergebnisse</h3>";
      // $str .= "    <h3><label class='label label-primary'>".count($theArticles)."</label> passende Einträge</h3>";
      $str .= "  </div>";
      $str .= "</div>";
      $str .= "<hr>";
      for ($i=0; $i<count($theArticles); $i++) {
          $theIssue = (strlen($theArticles[$i]->pubIssue)>0) ? " (".$theArticles[$i]->pubIssue.")" : "";
          $str .= "<div class='row'>";
          $str .= "  <div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>";
          $str .= "    <ul class='dgfo'><li>";
          $theAuthors = str_ireplace($snippet, "<strong class='text-danger'>".$snippet."</strong>", $theArticles[$i]->pubAuthors);
          $theTitle = str_ireplace($snippet, "<strong class='text-danger'>".$snippet."</strong>", $theArticles[$i]->pubTitle);
          $str .= "  <span class='authors'>".$theAuthors."</span> (".$theArticles[$i]->pubYear."): ";
          $str .= $theTitle;
          if ( (substr($theTitle,-1)!="?") && (substr($theTitle,-1)!="!") ) {
            $str .= ".";
          }
          $str .= " Articulata ".$theArticles[$i]->pubVolume.$theIssue.": ";
          $str .= $theArticles[$i]->pubPages;
          if (strlen($theArticles[$i]->pubLink)>0) {
            $path = "downloads/articulata/".$theArticles[$i]->pubLink;
            if (file_exists("./../".$path)) {
              $str .= "&nbsp;&nbsp;<a href='".$path."' target='_blank'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></a>";
            // } else {
            //   echo "&nbsp;&nbsp;<label class='label label-danger'>fehlt</label>";
            }
          }
          $str .= "    </li></ul>";
          $str .= "  </div>";
          $str .= "</div>";
      }

    } else {
      $str = "F - Keine Einträge für diese Suche gefunden";
    }

    echo $str;
    exit;
  }



  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //+++++  Suche nach Arten ueber die input box
  //+++++  - die Heuschrecken und Schaben / Ohrwuermer haben unterschiedliche
  //+++++    Ordnungen, ueber die der Artlink zustandekommt
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  if ( (!empty($_POST['getspecies'])) && ("ok" === $_POST['getspecies']) ) {

    $snippet = strip_tags(trim($_POST['val']));

    // gesucht wird der String an irgendeiner Stelle im Artnamen
    $srchterm = "%".$snippet."%";

    $theSpecies = Species::getSpeciesByName($pdo, $tblSpecies, $lutSys, $srchterm);

    $str = "<ul class='ac'>";
    if (count($theSpecies)>0) {
      for ($i=0; $i<count($theSpecies); $i++) {
        $name_ge = (strlen($theSpecies[$i]->name_ge)>0)
          ? " (".$theSpecies[$i]->name_ge.")" : "";

        // Link zusammensetzen
        $linkName = strtolower(str_replace(" ", "_", $theSpecies[$i]->name_sc));
        if (strpos($linkName, "(")>0) {
          $link = preg_replace('/\(.*?\)_|\s*/', '', $linkName);
        } else {
          $link = $linkName;
        }


        switch($theSpecies[$i]->orderID) {
          case 10: $lnk = "heuschrecken/arten/".$link; break;
          case 11: $lnk = "heuschrecken/arten/".$link; break;
          case 12: $lnk = "schaben/arten/".$link; break;
          case 13: $lnk = "schaben/arten/".$link; break;
          default: $lnk = "#"; break;
        }
        // $name_sc = str_ireplace($snippet, "<strong class='text-danger'>".$snippet."</strong>", $theSpecies[$i]->name_sc);
        // $name_ge = str_ireplace($snippet, "<strong class='text-danger'>".$snippet."</strong>", $name_ge);
        $str .= "<li><a href='".$lnk."'><em>".$theSpecies[$i]->name_sc."</em> ".$name_ge."</a></li>";
      }
    } else {
      $str .= "<li><a href='#'><em>- keine Arten gefunden! -</em></a></li>";
    }
    $str .= "</ul>";

    echo $str;

  }



  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //+++++  Zufallsbilder fuer den Startbereich suchen und vorbereiten
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  if ( (!empty($_POST['do'])) && ("loadRandomPics" === $_POST['do']) ) {

    $nr = intval(strip_tags(trim($_POST['nr'])));
    $container = array();

    while (count($container)<$nr) {
      $thePic = SpeciesPic::getRandomPic($pdo, $tblSpeciesPics);
      if (strlen($thePic->spPKID)>0) {
        if (file_exists("../images/species/".$thePic->pic)) {
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
      $str .= "<div class='col-md-3 col-sm-3'>";
      $str .= "  <a href='./heuschrecken/arten/".$link."' title='mehr Infos gibt es, wenn Sie das Bild anklicken'><img src='images/species/".str_ireplace('_lg.jpg', '_mi.jpg', $container[$i]->pic)."' alt='bild' class='img-rounded img-responsive'></a>";
      $str .= "  <div class='imgtitle'>";
      $str .= "    <p><em>".$container[$i]->picText."</em></p>";
      $str .= "  </div>";
      $str .= "</div>";
    }
    echo $str;
  }
?>
