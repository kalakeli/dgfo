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
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h1>Aktuelle Informationen</h1></br>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php include_once "includes/snippet_search.php"; ?>        
    </div>
  </div>


  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

<?php
  if (count($theNews)>0) {
    echo "<div class='row'>";
    echo "  <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";

    for ($i=0; $i<count($theNews); $i++) {
      list($y,$m,$d) = explode("-", $theNews[$i]->newsDate);
      echo "  <h3><small>".$d.".".$m.".".$y."</small></h3>";
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

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <h2></h2>

      <!-- Termine -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">TERMINE</h3>
        </div>
        <div class="panel-body">
          <!-- Termin -->
          <div class="row">
            <div class="col-sm-12 col-xs-12">
              <h4>23.-25. März 2018</h4>
              <p>
                15. Jahrestagung der DGfO im Naturkundemuseum Potsdam  <br>
                <ul class="dgfo"><li><a href="downloads/tagungen/2018_15_jahrestagung_dgfo_potsdam_ankuendigung.pdf" target="_blank">Flyer &nbsp;&nbsp;<i class='fa fa-file-pdf-o' aria-hidden='true'></i></a></li></ul>
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
                <ul class="dgfo"><li><a href="2017_seminar_umweltakademie_bw.pdf" target="_blank">Flyer &nbsp;&nbsp;<i class='fa fa-file-pdf-o' aria-hidden='true'></i></a></li></ul>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- Tagungen -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">TAGUNGEN</h4>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-sm-12 col-xs-12">
             Hier finden Sie alle Informationen zur nächsten DGfO-Jahrestagung, sowie einen Übersicht vergangener Tagungen: </p>
                 <ul class="dgfo">
                <li><a href="./aktuelles/jahrestagungen" target="_blank">Jahrestagungen

                </a></li></ul>
              </p>
            </div>
          </div>
        </div>
      </div>
<!-- Kontakt -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">KONTAKT | DGfO</h3>
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
      <p>&nbsp;</p>
    </div>

  </div>
</div>
