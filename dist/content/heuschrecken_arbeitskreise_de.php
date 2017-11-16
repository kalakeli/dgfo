<?php
  // deutschsprachige Seite Arbeitskreise
  // dient eigentlich nur als Weiche, damit der URL sauberer aussieht
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h1>Heuschrecken und Fangschrecken</h1>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php include_once "includes/snippet_search.php"; ?>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h2>Regionale Arbeitskreise</h2>
      <p>
        Hier finden Sie Informationen zu den regionalen Arbeitskreisen. Bitte
        wählen Sie.
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
          <p>
            <a href="heuschrecken/arbeitskreise/nrw/">
              <button type="button" name="button" class="btn btn-block btn-success">
                AK Heuschrecken in NRW
              </button>
            </a>
          </p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
          <p>
            <a href="heuschrecken/arbeitskreise/brandenburg/">
              <button type="button" name="button" class="btn btn-block btn-success">
                AK Heuschrecken in Brandenburg
              </button>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
