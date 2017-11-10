<?php
  // deutschsprachige Inhaltsseite der Articulata
  require_once "oo/publication.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-6">
      <h1>&bdquo;Articulata&ldquo;</h1>
      <h2>Inhalt</h2>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
      <h1>&nbsp;</h1>
      <p>
        <a href="./articulata/suche"><button type="button" class="btn btn-primary btn-block" name="button"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp; in Articulata suchen</button></a>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <p>
<?php
  $vols = Publication::getPubVolumes($pdo, $tblPub);
  if (count($vols)>0) {
    echo "<div class='row'>";
    for ($i=0; $i<count($vols); $i++) {
      echo "  <div class='col-lg-1 col-md-1 col-sm-2 col-xs-2'>";
      echo "    <p><a href='./articulata/inhalt/".$vols[$i]."'><button type='button' class='btn btn-block btn-success'>".$vols[$i]."</button></a></p>";
      echo "  </div>";
    }
    echo "</div>";
  }

?>
      </p>
    </div>
  </div>

<?php
  if (!empty($_GET["level2"])) {
    $theArticles = Publication::getPubsByVol($pdo, $tblPub, $_GET["level2"]);
    echo "<h2>Band ".$_GET["level2"];
  } else {
    $theArticles = Publication::getPubsByVol($pdo, $tblPub, $vols[0]); // umgekehrte Sortierung ;-)
    echo "<h2>Band ".$vols[0];
  }

  if (count($theArticles)>0) {

    if ($theArticles[0]->pubYear < $theArticles[count($theArticles)-1]->pubYear) {
      echo " (".$theArticles[0]->pubYear."-".$theArticles[count($theArticles)-1]->pubYear.")";
    } else {
      echo " (".$theArticles[0]->pubYear.")";
    }
    echo "</h2>";
    echo "<div class='row'>";
    echo "  <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
    $issue = "9999";
    for ($i=0; $i<count($theArticles); $i++) {
      if ($theArticles[$i]->pubIssue!=$issue) {
        echo "<hr>";
        if (strlen($theArticles[$i]->pubIssue)>0) {
          // manche Hefte haben kompl. PDF vorliegen, ebenso zu beruecksichtig
          // liegen immer im Verzeichnis 'complete'
          $f = "downloads/articulata/complete/articulata_".Publication::getRomanEquiv($theArticles[$i]->pubVolume)."_".$theArticles[$i]->pubIssue."_".$theArticles[$i]->pubYear."_gesamt.pdf";
          $lnk = (file_exists($f))
           ? "<a href='".$f."' target='_blank'><button type='button' class='btn btn-default'><img src='images/pdf.jpg' alt='pdf' class='img-rounded img-responsive' style='margin: 0 auto;'></button></a> &nbsp;<small>(Heft)</small>"
           : "";
          echo "<div class='row'>";
          echo "  <div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>";
          echo "     <h3>Heft ".$theArticles[$i]->pubIssue."</h3>";
          echo "  </div>";
          echo "  <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
          echo "     <h3>".$lnk."</h3>";
          echo "  </div>";
          echo "</div>";

        }
        $issue = $theArticles[$i]->pubIssue;
      }
      echo "<div class='row'>";
      echo "  <div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>";
      echo "   <ul class='dgfo'><li>";
      $theIssue = (strlen($theArticles[$i]->pubIssue)>0) ? " (".$theArticles[$i]->pubIssue.")" : "";
      echo "  <span class='authors'>".$theArticles[$i]->pubAuthors."</span> (".$theArticles[$i]->pubYear."): ";
      echo $theArticles[$i]->pubTitle.". Articulata ".$theArticles[$i]->pubVolume.$theIssue.": ";
      echo $theArticles[$i]->pubPages;
      echo "   </li></ul>";
      echo "  </div>";
      echo "  <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>";
      if (strlen($theArticles[$i]->pubLink)>0) {
        $path = "downloads/articulata/".$theArticles[$i]->pubLink;
        echo "<p>";
        if (file_exists($path)) {
          echo "<a href='".$path."' target='_blank'><button type='button' class='btn btn-default'><img src='images/pdf.jpg' alt='pdf' class='img-rounded ' style='margin: 0 auto;'></button></a>";
        } else {
          echo "<label class='label label-danger'>fehlt</label>";
        }
        echo "</p>";
      }
      echo "  </div>";
      echo "  <div class='col-lg-1 col-md-1 col-sm-1 col-xs-1'>";
      switch($theArticles[$i]->pubLang) {
        case "ge": echo "<p></p>"; break;
        case "en": echo "<p><img src='images/icon_engl.png' alt='english' class='img-rounded img-responsive' style='margin:5px 0 0 0;'></p>"; break;
        case "es": echo "<p><img src='images/icon_spain.png' alt='spanish' class='img-rounded img-responsive' style='margin:5px 0 0 0;'></p>"; break;
        default: echo "<p></p>"; break;
      }
      // if ($theArticles[$i]->pubLang=="en") {
      //   echo "<p>";
      //   echo "<img src='images/icon_engl.png' alt='english' class='img-rounded img-responsive' style='margin:5px 0 0 0;'>";
      //   echo "</p>";
      // }
      echo "  </div>";
      echo " </div>";
    }
    echo "  </div>";
    echo "</div>";
  }

?>


</div>
