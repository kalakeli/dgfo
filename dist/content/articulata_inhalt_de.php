<?php
  // deutschsprachige Inhaltsseite der Articulata
  require_once "oo/publication.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h1>ARTICULATA | Inhalt</h1></br>
</div>
</div>

<div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12"><?php
  // solange kein Band gewaehlt ist, die Cover anzeigen
  if (empty($_GET["level2"])) {

    echo "<h3>Jahresb&auml;nde</h3><br>";
    echo "    <p>";

    $vols = Publication::getPubVolumes($pdo, $tblPub);
    // 'Beihefte' soll nun nicht mehr mit angezeigt werden
    $vols = array_slice($vols, 1);

    if (count($vols)>0) {
      echo "<div class='row'>";
      for ($i=0; $i<count($vols); $i++) {
        $volStr = Publication::getYearStrForVolume($pdo, $tblPub, $vols[$i]);
        $picStr = "articulata_".$vols[$i]."_".str_replace("-", "_", $volStr).".jpg";
        $path = "images/cover_articulata_baende/".$picStr;

        // alle 6 Hefte eine neue Zeile beginnen
        if ( (bcmod("{$i}", "6") == 0) ) {
          echo "</div></br><div class='row'>";
        }

        echo "  <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
        if (file_exists($path)) {
          echo "<p style='position:relative;'><figure class='cover' id='".$vols[$i]."'><a href='./articulata/inhalt/".$vols[$i]."'><img src='".$path."' alt='cover ".$picStr."' class='img-responsive img-thumbnail'></a>";
          echo "</figure>";
          echo "<p><a href='./articulata/inhalt/".$vols[$i]."'>Band ".$vols[$i]." <br>(".$volStr.")</a></p>";
          echo "</p>";
        } else {
          echo "    <p><a href='./articulata/inhalt/".$vols[$i]."'>Band ".$vols[$i]." <br>(".$volStr.")</a></p>";
        }

        echo "  </div>";
      }
      echo "</div>";
    }

    echo "    </p>";

    // ----------------------------------------------------------------------
    // Beihefte
    // ----------------------------------------------------------------------

    echo "<h1>ARTICULATA | Beihefte</h1></br>";
    $vols = Publication::getPubBeihefte($pdo, $tblPub);

    if (count($vols)>0) {
      echo "<div class='row'>";
      for ($i=0; $i<count($vols); $i++) {
        $volStr = Publication::getYearStrForBeiheft($pdo, $tblPub, $vols[$i]);

        $picStr = "articulata_".strtolower(str_replace(" ", "_", $vols[$i]))."_".str_replace(" ", "_", $volStr).".jpg";
        $path = "images/cover_articulata_beihefte/".$picStr;

        // alle 6 Hefte eine neue Zeile beginnen
        if ( (bcmod("{$i}", "6") == 0) ) {
          echo "</div></br><div class='row'>";
        }

        echo "  <div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
        if (file_exists($path)) {
          echo "<p style='position:relative;'><figure class='cover' id='".$vols[$i]."'><a href='./articulata/inhalt/".strtolower(str_replace(" ", "_", $vols[$i]))."'><img src='".$path."' alt='cover ".$picStr."' class='img-responsive img-thumbnail'></a>";
          echo "</figure>";
          echo "<p><a href='./articulata/inhalt/".strtolower(str_replace(" ", "_", $vols[$i]))."'>".$vols[$i]."<br>(".$volStr.")</a></p>";
          echo "</p>";
        } else {
          echo "    <p><a href='./articulata/inhalt/".strtolower(str_replace(" ", "_", $vols[$i]))."'>".$vols[$i]." <br>(".$picStr.")</a></p>";
        }

        echo "  </div>";
      }
      echo "</div>";
    }

  } else {  // ++++++++++++ EIN BAND / BEIHEFT gewaehlt ++++++++++++++++++++++++

    $showBeiheft = false;
    $theVol = $_GET["level2"];
    if (substr($theVol, 0, 7) === "beiheft") {
      $theVol = str_replace("beiheft_", "Beiheft ", $theVol);
      $showBeiheft = true;
      echo "<h2>".$theVol;
      $theArticles = Publication::getPubsByBeiheft($pdo, $tblPub, $_GET["level2"]);
    } else {
      echo "<h2>Band ".$_GET["level2"];
      $theArticles = Publication::getPubsByVol($pdo, $tblPub, $_GET["level2"]);
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
             ? "<a href='".$f."' target='_blank'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></a>"
             : "";
            echo "<div class='row'>";
            echo "  <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
            echo "     <h3>Heft ".$theArticles[$i]->pubIssue." &nbsp;&nbsp;".$lnk."</h3>";
            echo "  </div>";
            echo "</div>";

          }
          $issue = $theArticles[$i]->pubIssue;
        }
        echo "<div class='row'>";
        echo "  <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
        echo "   <ul class='dgfo'><li>";
        $theIssue = (strlen($theArticles[$i]->pubIssue)>0) ? " (".$theArticles[$i]->pubIssue.")" : "";
        echo "  <span class='authors'>".$theArticles[$i]->pubAuthors."</span> (".$theArticles[$i]->pubYear."): ";
        echo (!showBeiheft)
          ? $theArticles[$i]->pubTitle.". Articulata ".$theArticles[$i]->pubVolume.$theIssue.": "
          : $theArticles[$i]->pubTitle.". Articulata ".$theArticles[$i]->pubIssue.": ";

        echo $theArticles[$i]->pubPages;
        if (strlen($theArticles[$i]->pubLink)>0) {
          $path = "downloads/articulata/".$theArticles[$i]->pubLink;
          if (file_exists($path)) {
            echo "&nbsp;&nbsp;<a href='".$path."' target='_blank'><i class='fa fa-file-pdf-o' aria-hidden='true'></i></a>";
          } else {
            echo "&nbsp;&nbsp;<label class='label label-danger'>fehlt</label>";
          }
        }
        echo "   </li></ul>";
        echo "  </div>";




        echo " </div>";
      }
      echo "  </div>";
      echo "</div>";
    }
  }
?>
    </div>
        

 <!-- rechte Seite -->
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">MEHR IN ARTICULATA</h3>
        </div>
        <div class="panel-body">
          <p>
            <ul class="dgfo"><li><a href="./articulata/autorenrichtlinien" target="_blank">
		
              <i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;Autorenrichtlinien 
            </a></li></ul>
          </p>
         
<p>
            <ul class="dgfo"><li><a href="./articulata/articulata_beihefte_de">
              
 		<i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;zu den Beiheften 
            </a></li></ul>
          </p>
          <p>
            <ul class="dgfo"><li><a href="./articulata/suche">
              <i class="fa fa-search" aria-hidden="true"></i>&nbsp;zur Suche 
            </a></li></ul>
          </p>
        </div>
      </div>
      <!-- Redaktion -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">KONTAKT | REDAKTION ARTICULATA</h3>
        </div>
        <div class="panel-body">
          
            <h4>Deutsche Gesellschaft f&uuml;r Orthopterologie</h4><h4>Georg Waeber</h4>
            <p>c/o Rennweg 9 <br>
            DE-91126 Rednitzhembach
          </p>
          <p>
            <strong>E-Mail:</strong> <a href="mailto:articulata@dgfo-articulata.de" title="">articulata(at)dgfo-articulata.de</a>

          </p>
        </div>
      </div>
      <!-- Bezug -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">KONTAKT | SCHRIFTENBEZUG</h3>
        </div>
        <div class="panel-body">
          
            <h4>Deutsche Gesellschaft f&ouml;r Orthopterologie</h4><h4>Josef Tumbrinck </h4>
            <p>c/o NABU Nordrhein-Westfalen <br>
            V&ouml;lklinger Stra&szlig;e 7&ndash;9 <br>
	DE-40219 D&uuml;sseldorf
          </p>
          <p>
            <strong>E-Mail:</strong> <a href="mailto:josef.tumbrinck@nabu-nrw.de" title="">josef.tumbrinck(at)nabu-nrw.de</a>


          </p>
        </div>
      </div>
    </div>

  </div>





</div>
