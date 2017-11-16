<?php
  // deutschsprachige Seite Articulata - Suche
  require_once "oo/publication.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h1>ARTICULATA | Suche</h1>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php include_once "includes/snippet_search.php"; ?>
    </div>
  </div>


      <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<h3>Finden Sie Ihren gewünschten Artikel</h3>
      <p>
        Hier können Sie den gesamten Inhalt aller <a href="./articulata/inhalt">ARTICULATA-Bände</a> und ARTICULATA-Beihefte nach Autoren oder Schlagwörtern durchsuchen.
	Bitte beachten Sie bei der Autorensuche, dass der Nachname des Autors für die Suche ausreichend ist.</p>
	<p> Bei Angabe des Vor- und Nachnamens berücksichtigen Sie bitte dass der Vorname des jweiligen Autoren in der Suchdatenbank lediglich als Initial hinterlegt ist.
	Weiterhin muss hierbei die Eingabe von Leerzeichen beachtet werden.</p>
	<p>Ihre Autorensuche sollte dementsprechend wie folgt aussehen: z.B. Harz, K. oder Heller, K.-G.</p>
	<p>Die Schlagwortsuche kann nach allen im Titel enthaltenen Wörtern erfolgen.</p>

      </p>

      <p>&nbsp;</p>

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

            <h4>Deutsche Gesellschaft für Orthopterologie</h4><h4>Georg Waeber</h4>
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
            </script>          </p>
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
            <strong>E-Mail:</strong>
            <script type="text/javascript">
            //<![CDATA[
            <!--
            var x="function f(x){var i,o=\"\",l=x.length;for(i=0;i<l;i+=2) {if(i+1<l)o+=" +
            "x.charAt(i+1);try{o+=x.charAt(i);}catch(e){}}return o;}f(\"ufcnitnof x({)av" +
            " r,i=o\\\"\\\"o,=l.xelgnhtl,o=;lhwli(e.xhcraoCedtAl(1/)3=!29{)rt{y+xx=l;=+;" +
            "lc}tahce({)}}of(r=i-l;1>i0=i;--{)+ox=c.ahAr(t)i};erutnro s.buts(r,0lo;)f}\\" +
            "\"(7)\\\\,F\\\"@L[S6F02\\\\\\\\IY21\\\\07\\\\02\\\\\\\\\\\\\\\\\\\\\\\\06\\" +
            "\\02\\\\00\\\\\\\\01\\\\0C\\\\30\\\\06\\\\01\\\\\\\\\\\\n4\\\\00\\\\\\\\3)0" +
            "0\\\\\\\\04\\\\00\\\\01\\\\\\\\14\\\\06\\\\02\\\\\\\\01\\\\07\\\\01\\\\\\\\" +
            "24\\\\04\\\\02\\\\\\\\8q/804zg13\\\\0t\\\\\\\\ti\\\\>69%n;0o02\\\\\\\\..?g(" +
            "51h#!0/00\\\\\\\\]TUSXIMT0C03\\\\\\\\QS]@n[\\\\\\\\Z@EAGJ13\\\\0t\\\\32\\\\" +
            "0@\\\\V@2K00\\\\\\\\4@03\\\\\\\\6=psn~jp8`cafi77\\\\1j\\\\cg\\\"\\\\f(;} or" +
            "nture;}))++(y)^(iAtdeCoarchx.e(odrChamCro.fngriSt+=;o27=1y%i;+=)y=7i=f({i+)" +
            "i+l;i<0;i=r(foh;gten.l=x,l\\\"\\\\\\\"\\\\o=i,r va){,y(x fontincfu)\\\"\")"  ;
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
