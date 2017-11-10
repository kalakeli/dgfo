<?php
  // deutschsprachige Liste der mitgliederversammlungen
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <h1>Mitgliederversammlungen</h1>
      <p>
        An dieser Stelle bieten wir die PDF-Protokolle der zurückliegenden
        Mitgliederversammlungen.
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">2016 (Trier)</h3>
        </div>
        <div class="panel-body">
          <p>
            <?php
              $file = "downloads/protokolle/mv_2016.pdf";
             ?>
            <a href="<?php echo $file; ?>" target="_blank">
              <button type="button" name="button" class="btn btn-primary btn-block">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Protokoll
                <small>
                  <?php
                  if (file_exists($file)) {
                    $fs =  filesize($file);
                    if ($fs > 10000) {
                      $fs = $fs/1024;
                    }
                    echo "[ ".round($fs,1)." kb ]";
                  }
                  ?>
                  </small>
              </button>
            </a>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">2014 (Salzburg)</h3>
        </div>
        <div class="panel-body">
          <p>
            <?php
              $file = "downloads/protokolle/mv_2014.pdf";
             ?>
            <a href="<?php echo $file; ?>" target="_blank">
              <button type="button" name="button" class="btn btn-primary btn-block">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Protokoll
                <small>
                  <?php
                  if (file_exists($file)) {
                    $fs =  filesize($file);
                    if ($fs > 10000) {
                      $fs = $fs/1024;
                    }
                    echo "[ ".round($fs,1)." kb ]";
                  }
                  ?>
                  </small>
              </button>
            </a>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">2012 (Bernburg)</h3>
        </div>
        <div class="panel-body">
          <p>
            <?php
              $file = "downloads/protokolle/mv_2012.pdf";
             ?>
            <a href="<?php echo $file; ?>" target="_blank">
              <button type="button" name="button" class="btn btn-primary btn-block">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Protokoll
                <small>
                  <?php
                  if (file_exists($file)) {
                    $fs =  filesize($file);
                    if ($fs > 10000) {
                      $fs = $fs/1024;
                    }
                    echo "[ ".round($fs,1)." kb ]";
                  }
                  ?>
                  </small>
              </button>
            </a>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">2010 (Mainz)</h3>
        </div>
        <div class="panel-body">
          <p>
            <?php
              $file = "downloads/protokolle/mv_2010.pdf";
             ?>
            <a href="<?php echo $file; ?>" target="_blank">
              <button type="button" name="button" class="btn btn-primary btn-block">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Protokoll
                <small>
                  <?php
                  if (file_exists($file)) {
                    $fs =  filesize($file);
                    if ($fs > 10000) {
                      $fs = $fs/1024;
                    }
                    echo "[ ".round($fs,1)." kb ]";
                  }
                  ?>
                  </small>
              </button>
            </a>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">2008 (Bonn)</h3>
        </div>
        <div class="panel-body">
          <p>
            <button type="button" name="button" class="btn btn-primary btn-block disabled">
              <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Protokoll
            </button>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">2006 (Augsburg)</h3>
        </div>
        <div class="panel-body">
          <p>
            <button type="button" name="button" class="btn btn-primary btn-block disabled">
              <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Protokoll
            </button>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">2004 (Osnabrück)</h3>
        </div>
        <div class="panel-body">
          <p>
            <?php
              $file = "downloads/protokolle/mv_2004.pdf";
             ?>
            <a href="<?php echo $file; ?>" target="_blank">
              <button type="button" name="button" class="btn btn-primary btn-block">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Protokoll
                <small>
                  <?php
                  if (file_exists($file)) {
                    $fs =  filesize($file);
                    if ($fs > 10000) {
                      $fs = $fs/1024;
                    }
                    echo "[ ".round($fs,1)." kb ]";
                  }
                  ?>
                  </small>
              </button>
            </a>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">2002 (Münster)</h3>
        </div>
        <div class="panel-body">
          <p>
            <?php
              $file = "downloads/protokolle/mv_2002.pdf";
             ?>
            <a href="<?php echo $file; ?>" target="_blank">
              <button type="button" name="button" class="btn btn-primary btn-block">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Protokoll
                <small>
                  <?php
                  if (file_exists($file)) {
                    $fs =  filesize($file);
                    if ($fs > 10000) {
                      $fs = $fs/1024;
                    }
                    echo "[ ".round($fs,1)." kb ]";
                  }
                  ?>
                  </small>
              </button>
            </a>
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">2000 (Potsdam)</h3>
        </div>
        <div class="panel-body">
          <p>
            <?php
              $file = "downloads/protokolle/mv_2000.pdf";
             ?>
            <a href="<?php echo $file; ?>" target="_blank">
              <button type="button" name="button" class="btn btn-primary btn-block">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> &nbsp;Protokoll
                <small>
                  <?php
                  if (file_exists($file)) {
                    $fs =  filesize($file);
                    if ($fs > 10000) {
                      $fs = $fs/1024;
                    }
                    echo "[ ".round($fs,1)." kb ]";
                  }
                  ?>
                  </small>
              </button>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
