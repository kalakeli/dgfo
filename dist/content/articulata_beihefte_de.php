<?php
  // deutschsprachige Inhaltsseite der Articulata
  require_once "oo/publication.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h1>ARTICULATA | Inhalt</h1>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php include_once "includes/snippet_search.php"; ?>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h3>Beihefte</h3>
<?php
  // solange kein Band gewaehlt ist, die Cover anzeigen
  if (empty($_GET["level2"])) {

    echo "<h2></h2>";

    // ----------------------------------------------------------------------
    // Beihefte
    // ----------------------------------------------------------------------
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
          echo "<p><small><a href='./articulata/inhalt/".strtolower(str_replace(" ", "_", $vols[$i]))."'>".$vols[$i]."<br>(".$volStr.")</a></small></p>";
          echo "</p>";
        } else {
          echo "    <p><small><a href='./articulata/inhalt/".strtolower(str_replace(" ", "_", $vols[$i]))."'>".$vols[$i]." <br>(".$picStr.")</a</small>></p>";
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
        <h2></h2>
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
            <ul class="dgfo"><li><a href="./articulata/inhalt">

 		<i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;zu den Jahresbänden
            </a></li></ul>
          </p>
<p>
            <ul class="dgfo"><li><a href="./articulata/beihefte">

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
            <strong>E-Mail:</strong>
            <script type="text/javascript">
            //<![CDATA[
            <!--
            var x="function f(x){var i,o=\"\",l=x.length;for(i=l-1;i>=0;i--) {try{o+=x.c" +
            "harAt(i);}catch(e){}}return o;}f(\")\\\"function f(x,y){var i,o=\\\"\\\\\\\""+
            "\\\\,l=x.length;for(i=0;i<l;i++){if(i<98)y++;y%=127;o+=String.fromCharCode(" +
            "x.charCodeAt(i)^(y++));}return o;}f(\\\"\\\\\\\\\\\\007\\\\\\\\n\\\\\\\\004" +
            "\\\\\\\\034\\\\\\\\006\\\\\\\\010\\\\\\\\001\\\\\\\\005]\\\\\\\\002\\\\\\\\" +
            "005\\\\\\\\020\\\\\\\\017\\\\\\\\030ll,$4k,fbwr+D8q\\\\\\\\177INPI\\\\\\\\0" +
            "22K^ZYQAZYN]~$%\\\\\\\\\\\"\\\\)e+>:91!:9.=p\\\\\\\\004\\\\\\\\0078DH\\\\\\" +
            "\\036\\\\\\\\005\\\\\\\\032\\\\\\\\034\\\\\\\\027I*Z&^@`qqnj~anerUs~}r2@QQN" +
            "K\\\\\\\\\\\\\\\\FJXL\\\\\\\\000KU\\\\\\\\r\\\\\\\\035R\\\\\\\\n\\\\\\\\027" +
            "\\\\\\\\037\\\\\\\\014\\\\\\\\010\\\\\\\\002\\\"\\\\,98)\\\"(f};)lo,0(rtsbu" +
            "s.o nruter};)i(tArahc.x=+o{)--i;0=>i;1-l=i(rof}}{)e(hctac};l=+l;x=+x{yrt{)2" +
            "9=!)31/l(tAedoCrahc.x(elihw;lo=l,htgnel.x=lo,\\\"\\\"=o,i rav{)x(f noitcnuf" +
            "\")"                                                                         ;
            while(x=eval(x));
            //-->
            //]]>
            </script>
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
            <strong>E-Mail:</strong>
            <script type="text/javascript">
            //<![CDATA[
            <!--
            var x="function f(x){var i,o=\"\",l=x.length;for(i=0;i<l;i+=2) {if(i+1<l)o+=" +
            "x.charAt(i+1);try{o+=x.charAt(i);}catch(e){}}return o;}f(\"ufcnitnof x({)av" +
            " r,i=o\\\"\\\"o,=l.xelgnhtl,o=;lhwli(e.xhcraoCedtAl(1/)3=!84{)rt{y+xx=l;=+;" +
            "lc}tahce({)}}of(r=i-l;1>i0=i;--{)+ox=c.ahAr(t)i};erutnro s.buts(r,0lo;)f}\\" +
            "\"(7),6\\\"\\\\EMZOOP21\\\\0@\\\\0R01\\\\\\\\10\\\\0E\\\\35\\\\03\\\\03\\\\" +
            "\\\\06\\\\0J\\\\23\\\\07\\\\00\\\\\\\\05\\\\0r\\\\\\\\\\\\\\\"\\\\\\\\\\\\\\"+
            "\\n3\\\\00\\\\\\\\71>//6v-31;&l94s01\\\\\\\\2m02\\\\\\\\)p>'qo!$d^Pd\\\\n6\\"+
            "\\01\\\\\\\\25\\\\0W\\\\14\\\\02\\\\03\\\\\\\\26\\\\00\\\\03\\\\\\\\7503\\\\"+
            "\\\\20\\\\04\\\\03\\\\\\\\30\\\\02\\\\00\\\\\\\\\\\\r3\\\\00\\\\\\\\30\\\\0" +
            "0\\\\03\\\\\\\\4E01\\\\\\\\14\\\\03\\\\03\\\\\\\\10\\\\04\\\\01\\\\\\\\3_01" +
            "\\\\\\\\27\\\\06\\\\01\\\\\\\\10\\\\01\\\\00\\\\\\\\|201\\\\0a\\\\?=0+7wvi<" +
            "{5=';;?>e-'3*+&\\\\'(\\\"}fo;n uret}r);+)y+^(i)t(eAodrCha.c(xdeCoarChomfrg." +
            "intr=So+7;12%=;y=iy+7)=6i=f({i+)i+l;i<0;i=r(foh;gten.l=x,l\\\"\\\\\\\"\\\\o" +
            "=i,r va){,y(x fontincfu)\\\"\")"                                             ;
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
