<?php
  // deutschsprachige Hauptseite der aktuellen Informationen

  include_once "oo/news.php";

  // wie viele Nachrichten sollen angezeigt werden? hier angeben
  $nr = 10;
  // -------

  $theNews = News::getLastXNews($pdo, $tblNews, $nr);
  $nrTotal = News::getNewsNr($pdo, $tblNews);

?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>Aktuelle Informationen</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
      <h2>Aktuelles</h2>
<?php
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
    echo "<p class='text text-danger'>Aktuell liegen keine Nachrichten vor!</p>";
  }
?>
    </div>

    <!-- rechte Seite -->

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <h2>Termine</h2>
      <!-- Termine -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Termine</h3>
        </div>
        <div class="panel-body">
          <!-- Termin -->
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <h4>23.-25. März 2018</h4>
              <p>
                15. Jahrestagung der DGfO im Naturkundemuseum Potsdam  <br>
                <a href="downloads/tagungen/2018_15_jahrestagung_dgfo_potsdam_ankuendigung.pdf" target="_blank">Flyer</a>
              </p>
            </div>
          </div>
          <!-- naechster Termin -->
          <hr>
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <h4>21.–22. Juli 2017</h4>
              <p>
                Seminar der Umweltakademie Baden-Württemberg: Bioindikatoren der
                Landschaft: Heuschrecken – Zeigerarten <br>
                <a href="2017_seminar_umweltakademie_bw.pdf" target="_blank">Flyer</a>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Tagungen -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Tagungen</h3>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <p>
                Hier finden Sie Informationen zur nächsten und
                einen Rückblick der vergangenen <a href="./aktuelles/jahrestagungen">Jahrestagungen</a>
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
