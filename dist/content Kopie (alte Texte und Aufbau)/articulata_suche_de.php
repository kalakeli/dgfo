<?php
  // deutschsprachige Seite Articulata - Suche
  require_once "oo/publication.php";
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>&bdquo;Articulata&ldquo;</h1>
      <h2>Suche</h2>
      <p>
        Sie suchen etwas Bestimmtes, wollen sich aber nicht durch den <a href="./articulata/inhalt">Inhalt</a>
        arbeiten? Kein Problem - benutzen Sie einfach unsere Suche.
      </p>
      <p>
        Bände und Hefte finden Sie auf den <a href="./articulata/inhalt">Inhaltsseiten</a>,
        hier können Sie die
        <label for="anzahl Beiträge" class="label label-primary"><?php echo Publication::getNrArticles($pdo, $tblPub); ?> Beiträge</label>
        durchsuchen. <br>
        Noch ein Hinweis: Der Nachname reicht, aber geben Sie Nachnamen und Vornamen an, beachten Sie bitte,
        dass Autoren immer in der Form <em>Nachname, Initialen</em> eingetragen sind.
        Bsp.: <strong><em>Harz, K.</em></strong>.
        Beachten Sie die Leerzeichen!
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <form class="form-inline" name="srchArticulata" id="srchArticulata">
        <input type="hidden" name="srch" value="ok">
        <div class="form-group">
          <input type="text" class="form-control" name="srchterm" id="id_srchterm" placeholder="Suchbegriff / Autor">
        </div>
        <button type="submit" id="id_btn_srch" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;suchen</button>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h2>Suchergebnis</h2>
      <div id="srchresult">
        <h3 class="alert alert-warning">Geben Sie Suchtext ein</h3>
      </div>
    </div>
  </div>

</div>

<script src="js/_srch.js"></script>
