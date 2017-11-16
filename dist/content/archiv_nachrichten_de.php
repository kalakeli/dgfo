<?php
  // deutschsprachige Seite der archivierten Meldungen

  include_once "oo/news.php";

  // in diesen Jahren liegen Nachrichten vor
  $theYears = News::getNewsYears($pdo, $tblNews);

  // ist kein Jahr bestimmt, wird das aktuelle angezeigt
  $y = (strlen($_GET["level2"])>0) ? $_GET["level2"] : date("Y");

  $theNews = News::getNewsBetween($pdo, $tblNews, $y."-01-01", $y."-12-31");


?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h1>Aktuelle Informationen</h1></br>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php include_once "includes/snippet_search.php"; ?>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h2>Archivierte Meldungen</h2>
<?php
  // Jahre fuer die Auswahl anzeigen
  echo "<div class='row'>";
  for ($i=0; $i<count($theYears); $i++) {
    echo "  <div class='col-lg-1 col-md-1 col-sm-2 col-xs-2'>";
    echo "    <p><a href='./aktuelles/archivierte_nachrichten/".$theYears[$i]."'><button type='button' class='btn btn-block btn-success'>".$theYears[$i]."</button></a></p>";
    echo "  </div>";
  }
  echo "</div>";

  if (count($theNews)>0) {
    echo "<div class='row'>";
    echo "  <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";

    for ($i=0; $i<count($theNews); $i++) {
      list($y,$m,$d) = explode("-", $theNews[$i]->newsDate);
      echo "  <h3>".$d.".".$m.".".$y."</h3>";
      echo "  <h3>".$theNews[$i]->newsTitle."</h3>";
      echo $theNews[$i]->newsText; // muss formatiert in der DB liegen
      echo "<hr>";
    }
    echo "  </div> \n";
    echo "</div> \n";

    // falls es ein Archiv gibt, dann hier anzeigen
    if (count($theNews) < $nrTotal) {
      echo "<div class='row'>";
      echo "  <div class='col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10'>";
      echo "<p><a href='./aktuelles/archivierte_nachrichten' class='nosign'><button type='button' class='btn btn-primary btn-block' name='archiv'>weitere Nachrichten</button></a></p>";
      echo "  </div> \n";
      echo "</div> \n";
    }

  } else {
    echo "<p class='text text-danger'>Für ".$y." liegen keine Nachrichten vor!</p>";
  }
?>
    </div>



  </div>
</div>
