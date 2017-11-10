<?php
  // deutschsprachige Seite Articulata - Suche
  require_once "oo/publication.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h1>ARTICULATA | Suche</h1><br>
</div></div>
      <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<h3>Finden Sie Ihren gewünschten Artikel</h3><br>
      <p>
        Hier können Sie den gesamten Inhalt aller <a href="./articulata/inhalt">ARTICULATA-Bände</a> und ARTICULATA-Beihefte nach Autoren oder Schlagwörtern durchsuchen.
	Bitte beachten Sie bei der Autorensuche, dass der Nachname des Autors für die Suche ausreichend ist.</p>
	<p> Bei Angabe des Vor- und Nachnamens berücksichtigen Sie bitte dass der Vorname des jweiligen Autoren in der Suchdatenbank lediglich als Initial hinterlegt ist.
	Weiterhin muss hierbei die Eingabe von Leerzeichen beachtet werden.</p>
	<p>Ihre Autorensuche sollte dementsprechend wie folgt aussehen: z.B. Harz, K. oder Heller, K.-G.</p>
	<p>Die Schlagwortsuche kann nach allen im Titel enthaltenen Wörtern erfolgen.</p>
        
      </p><br>
      <p>
        
      </p>
 
  
      <form class="form-inline" name="srchArticulata" id="srchArticulata">
        <input type="hidden" name="srch" value="ok">
        <div class="form-group">
          <input type="text" class="form-control" name="srchterm" id="id_srchterm" placeholder="Suchbegriff / Autor">
        </div>
        <button type="submit" id="id_btn_srch" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;suchen</button>
      </form>
    
  
      <h2></h2>
      <div id="srchresult">
        <h3></h3>
      </div>
    

</div>

<script src="js/_srch.js"></script>

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
            <ul class="dgfo"><li><a href="./articulata/inhalt">
              
 		<i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;zu den Jahresbänden 
            </a></li></ul>
          </p>
<p>
            <ul class="dgfo"><li><a href="./articulata/articulata_beihefte_de">
              
 		<i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;zu den Beiheften 
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
          
            <h4>Deutsche Gesellschaft für Orthopterologie</h4><h4>Georg Waeber</h4>
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
          
            <h4>Deutsche Gesellschaft für Orthopterologie</h4><h4>Josef Tumbrinck </h4>
            <p>c/o NABU Nordrhein-Westfalen <br>
            Völklinger Straße 7–9 <br>
	DE-40219 Düsseldorf
          </p>
          <p>
            <strong>E-Mail:</strong> <a href="mailto:josef.tumbrinck@nabu-nrw.de" title="">josef.tumbrinck(at)nabu-nrw.de</a>


          </p>
        </div>
      </div>
    </div>

  </div>
</div>
