<?php session_start(); ?><!DOCTYPE html>
<html lang=de>
  <head>
    <base href="http://karsten-berlin.net/parked/dgfo/">
    <meta charset=utf-8>
    <meta content="width=device-width,initial-scale=1" name=viewport>
    <title>Deutsche Gesellschaft für Orthopterologie</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!-- lightbox -->
    <link href="css/lightbox.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="css/styles.min.css" rel="stylesheet">
    <!-- Hint Toolbox - thanks to http://kushagragour.in/lab/hint/ -->
    <link href="css/hint.min.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/ico" href="favicon.ico">
    <!-- text and headline font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald" rel="stylesheet">

    <!-- jQuery (u.a. wg Bootstrap) -->
    <script
    			  src="http://code.jquery.com/jquery-1.12.4.min.js"
    			  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
    			  crossorigin="anonymous"></script>

    <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
  </head>
  <body>

<?php
    // initiale Sprache bestimmen
    $lang = "de";
    if (isset($_COOKIE["lang"])) {
        $lang = $_COOKIE["lang"];
    }

    require_once "includes/db_inc.php";
    require_once "oo/species.php";

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


?>

<?php include_once "includes/nav_de.php"; ?>

<div class="container-fluid header">
  <!-- <img src="images/logos/dgfo_dietrich_bornhalm_th.jpg" id="dgfo_logo" class="img-responsive" alt="Logo DGFO (Dietrich Bornhalm)"> -->
  <h1 class="title"><span id="title_normal">Deutsche Gesellschaft für Orthopterologie e.V.</span><span id="title_mobile">DGfO</span></h1>
  <div class="row" id="id_headerpics">
  </div>
<?php
  // Breadcrumbs
  echo "<div class='container-fluid'><div class='row'>
          <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>";
  // echo "<hr>";
  echo "<div class='row'>
          <div class='col-lg-9 col-md-9 col-sm-12 col-xs-12 breadcrumbs'>";
  echo "<p><small>";
  echo "<a href='./'><i class='fa fa-home' aria-hidden='true'></i></a>&nbsp;&nbsp;";
  echo "<i class='fa fa-caret-right' aria-hidden='true'></i>&nbsp;&nbsp;";
  if (strlen($_GET["top"])>0) {
    echo "<a href='./".$_GET['top']."'>".strtoupper($_GET["top"])."</a>";
  } else {
    echo " Startseite";
  }
  if (strlen($_GET["sub"])>0) {
    echo "&nbsp;&nbsp;<i class='fa fa-caret-right' aria-hidden='true'></i>&nbsp;&nbsp;";
    echo "<a href='./".$_GET['top']."/".$_GET['sub']."'>".strtoupper($_GET["sub"])."</a>";
  }
  if (strlen($_GET["level2"])>0) {
    echo "&nbsp;&nbsp;<i class='fa fa-caret-right' aria-hidden='true'></i>&nbsp;&nbsp;";
    echo "<a href='./".$_GET['top']."/".$_GET['sub']."/".$_GET["level2"]."'>".str_ireplace('_', ' ', strtoupper($_GET["level2"]))."</a>";
  }
  echo "</small></p>";

  // Box auf der rechten Seite der breadcrumbs
  echo "     <div class='rightbox'>";
  echo "<p><small>";
  $title = ($lang == "en") ? "send us an e-mail" : "schicken Sie uns eine E-Mail";
  echo "<a class='nosign' title='".$title."' href='mailto:t.fartmann@uos.de'><i class='fa fa-envelope' aria-hidden='true'></i></a>";
  echo "<a href='./' onclick=\"switchLang('en');\">EN</a> |
        <a href='./' onclick=\"switchLang('de');\">DE</a>";
  echo "</small></p>";
  echo "     </div>";
  echo "  </div>";

  echo "  <div class='col-lg-3 col-md-3 col-sm-12 col-xs-12 righttop'>";
  echo "<p class='text-center'><small>";
  echo ($lang == "en") ? "MORE INFORMATION" : "MEHR INFORMATIONEN";
  echo "</small></p>";

  echo "  </div>";
  echo "</div>";
  echo "</div></div></div>";

  echo "<hr>";
?>
</div>



<div class="page-wrap">


<?php

  if (empty($_GET)) {
    $fn = "content/startseite_".$lang.".php";
  } else {
    switch ($_GET["top"]) {
      case 'start':
        $fn = "content/startseite_".$lang.".php";
        if (!file_exists($fn)) $fn = "content/startseite_de.php";
        break;
      case 'aktuelles':
        if (strlen($_GET["sub"])==0) {
          $fn = "content/aktuelles_".$lang.".php";
          if (!file_exists($fn)) $fn = "content/aktuelles_de.php";
        } else {
          switch ($_GET["sub"]) {
            case "jahrestagungen": $fn = "content/jahrestagungen_".$lang.".php";
            switch ($_GET["level2"]) {
              case "2014_salzburg": $fn = "content/tagungen/2014_salzburg_".$lang.".php";  break;
              case "2012_bernburg": $fn = "content/tagungen/2012_bernburg_".$lang.".php";  break;
              case "2010_mainz": $fn = "content/tagungen/2010_mainz_".$lang.".php";  break;
              case "2008_bonn": $fn = "content/tagungen/2008_bonn_".$lang.".php";  break;
              case "2006_augsburg": $fn = "content/tagungen/2006_augsburg_".$lang.".php";  break;
              case "2004_osnabrueck": $fn = "content/tagungen/2004_osnabrueck_".$lang.".php";  break;
              case "2002_muenster": $fn = "content/tagungen/2002_muenster_".$lang.".php";  break;
              case "2000_potsdam": $fn = "content/tagungen/2000_potsdam_".$lang.".php";  break;
              default: $fn = "content/jahrestagungen_".$lang.".php"; break;
            }
            break;
            case "archivierte_nachrichten": $fn = "content/archiv_nachrichten_".$lang.".php";  break;
            default: $fn = "content/aktuelles_".$lang.".php"; break;
          }
        }
        break;
      case 'mitgliedschaft':
        $fn = "content/mitgliedschaft_".$lang.".php";
        if (!file_exists($fn)) $fn = "content/mitgliedschaft_de.php";
        break;
      case 'forschungsfoerderung':
        $fn = "content/forschungsfoerderung_".$lang.".php";
        if (!file_exists($fn)) $fn = "content/forschungsfoerderung_de.php";
        break;
      case 'dgfo':
        if (strlen($_GET["sub"])==0) {
          $fn = "content/dgfo_".$lang.".php";
          if (!file_exists($fn)) $fn = "content/dgfo_de.php";
        } else {
          switch ($_GET["sub"]) {
            case "satzung":
              $fn = "content/satzung_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/satzung_de.php";
              break;
            default: $fn = "content/dgfo_".$lang.".php"; break;
          }
        }
        break;
      case 'articulata':
        if (strlen($_GET["sub"])==0) {
          $fn = "content/articulata_".$lang.".php";
          if (!file_exists($fn)) $fn = "content/articulata_de.php";
        } else {
          switch ($_GET["sub"]) {
            case "inhalt":
              $fn = "content/articulata_inhalt_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/articulata_inhalt_de.php";
              break;
            case "beihefte":
              $fn = "content/articulata_beihefte_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/articulata_beihefte_de.php";
              break;
            case "autorenrichtlinien": $fn = "content/articulata_richtlinien_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/articulata_richtlinien_de.php";
              break;
            case "restbestaende": $fn = "content/articulata_restbestaende_".$lang.".php";  break;
            case "suche": $fn = "content/articulata_suche_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/articulata_suche_de.php";
              break;
            default: $fn = "content/articulata_".$lang.".php"; break;
          }
        }
        break;
      case 'heuschrecken':
        if (strlen($_GET["sub"])==0) {
          $fn = "content/heuschrecken_".$lang.".php";
          if (!file_exists($fn)) $fn = "content/heuschrecken_de.php";
        } else {
          switch ($_GET["sub"]) {
            case "arten": $fn = "content/heuschrecken_arten_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/heuschrecken_arten_de.php";
              break;
            case "arbeitskreise":
              $fn = "content/heuschrecken_arbeitskreise_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/heuschrecken_arbeitskreise_de.php";
              switch ($_GET["level2"]) {
                case "nrw": $fn = "content/arbeitskreise/ak_heuschrecken_nrw_".$lang.".php";
                  if (!file_exists($fn)) $fn = "content/arbeitskreise/ak_heuschrecken_nrw_de.php";
                  break;
                case "brandenburg": $fn = "content/arbeitskreise/ak_heuschrecken_bb_".$lang.".php";
                  if (!file_exists($fn)) $fn = "content/arbeitskreise/ak_heuschrecken_bb_de.php";
                  break;
                default: $fn = "content/heuschrecken_arbeitskreise_".$lang.".php";
                  if (!file_exists($fn)) $fn = "content/heuschrecken_arbeitskreise_de.php";
                  break;
              }
            break;
            case "literatur": $fn = "content/heuschrecken_literatur_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/heuschrecken_literatur_de.php";
              break;
            default: $fn = "content/heuschrecken_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/heuschrecken_de.php";
              break;
          }
        }
        break;
      case 'schaben':
        if (strlen($_GET["sub"])==0) {
          $fn = "content/schaben_".$lang.".php";
          if (!file_exists($fn)) $fn = "content/schaben_de.php";
        } else {
          switch ($_GET["sub"]) {
            case "arten": $fn = "content/schaben_arten_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/schaben_arten_de.php";
              break;
            default: $fn = "content/schaben_".$lang.".php";
              if (!file_exists($fn)) $fn = "content/schaben_de.php";
              break;
          }
        }
        break;
      case 'ohrwuermer':
        $fn = "content/schaben_".$lang.".php";
        if (!file_exists($fn)) $fn = "content/schaben_de.php";
        break;
      case 'impressum':
        $fn = "content/impressum_de.php";
        break;
      case 'kontakt':
        $fn = "content/kontakt_de.php";
        break;
      default:
        $fn = "content/page_unknown.php";
        break;
    }
  }

  // Seite entsprechend Auswahl einlesen
  if (file_exists($fn)) {
    include_once $fn;
  } else {
    include_once "includes/page_not_found.php";
    echo $fn;
  }
?>

</div>

  <!-- footer -->

  <div class="container" id="dgfo_footer">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="text-muted pull-right">
              <img src="images/logos/dgfo_dietrich_bornhalm.jpg" id="dgfo_logo" class="img-responsive" alt="Logo DGFO (Dietrich Bornhalm)">
              <div id="id_impressum">
                <small><a href="./impressum">Impressum</a></small>
                |
                <small>© DGfO <?php echo date("Y"); ?></small>
              </div>
            </p>
        </div>
      </div>
  </div>

</div>


    <!-- Include all compiled plugins for Bootstrap -->
    <script src="js/bootstrap.min.js" async></script>
    <!-- Include lightbox -->
    <script src="js/lightbox.min.js" async></script>
    <!-- Include Navigation -->
    <!-- <script src="js/menu.js" async></script> -->
    <!-- Include picloader and search -->
    <script src="js/_misc.js"></script>
    <script async src="js/_srch.js"></script>
    <script>
    // Menu anzeigen auf kleinen Bildschirmen
    var hamburger = document.querySelector('.hamburger');
    var drawer = document.querySelector('.navigation');
    var pw = document.querySelector('.page-wrap');
    var header = document.querySelector('.header');

    hamburger.addEventListener('click', function(e) {
      drawer.classList.toggle('open');
      pw.classList.toggle('open');
      header.classList.toggle('open');
      e.stopPropagation();
    });

    function switchLang(lng) {
      var d = new Date();
      d.setTime(d.getTime() + (365*24*60*60*1000));
      var expires = "expires="+ d.toUTCString();
      document.cookie = "lang="+lng+"; expires="+expires+"; path=/";
      document.location.reload();
    }

    $(document).ready(function() {
      // Artenabfrage
      $('#id_ac_s').keyup(function() {
        getSpeciesByName($('#id_ac_s').val());
      });
      // Bilderabfrage fuer den Kopf
      loadRandomPics("id_headerpics", 4);
    });
    </script>
  </body>
</html>
