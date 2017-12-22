<?php
  // deutschsprachige Kontaktseite
?>

<div class="container-fluid">

  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <h1>Kontakt </h1>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php include_once "includes/snippet_search.php"; ?>
    </div>
  </div>


  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <h3>Schicken Sie uns eine Nachricht</h3>
      <p>Wenn Sie uns eine Nachricht schicken möchten, können Sie dies hier tun.</p>
    </div>
  </div>

  <!-- Formular -->
  <div class="row">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
      <form class="form-horizontal" id="fMail" method="post">
        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">
            Name <small><sup>1</sup></small>
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputName" placeholder="Ihr Name" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail" class="col-sm-2 control-label">
            E-Mail <small><sup>1</sup></small>
          </label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" placeholder="E-Mail" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddr" class="col-sm-2 control-label">Anschrift</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputAddr" placeholder="Anschrift">
          </div>
        </div>
        <div class="form-group">
          <label for="inputTarget" class="col-sm-2 control-label">
            Ziel <small><sup>1</sup></small>
          </label>
          <div class="col-sm-10">
            <select class="form-control" id="selTarget" required>
              <option value=""> -- wen möchten Sie erreichen? -- </option>
              <option value="ARTICULATA">ARTICULATA</option>
              <option value="Nachbestellung von Heften">Nachbestellung von Heften</option>
              <option value="Adressänderung">Adressänderung</option>
              <option value="Mitgliedschaft">Mitgliedschaft</option>
              <option value="Überweisungsprobleme">Überweisungsprobleme</option>
              <option value="Fachfragen">Fachfragen</option>
              <option value="Vorstand">Vorstand</option>
              <option value="Webmaster">Webmaster</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputSubject" class="col-sm-2 control-label">
            Titel <small><sup>1</sup></small>
          </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputSubject" placeholder="Titel der Nachricht" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputMsg" class="col-sm-2 control-label">
            Nachricht <small><sup>1</sup></small>
          </label>
          <div class="col-sm-10">
            <textarea class="form-control" rows="10" id="inputMsg" placeholder="Ihre Nachricht an uns" required></textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Abschicken</button>
          </div>
        </div>

        <div class="form-group">
          <label for="inputMsg" class="col-sm-2 control-label">
            &nbsp;
          </label>
          <!-- <div class="col-sm-10">
            <div class="g-recaptcha" data-sitekey="6LdaAzkUAAAAALrTpxsKHuIPPfSfvsYe3pisVyVx"></div>
          </div> -->
        </div>

      </form>

      <div class="row">
        <div class="col-sm-offset-2 col-sm-10 msg" id="msg"></div>
      </div>


      <div class="row">
        <div class="col-sm-10">
          <sup>
            1
          </sup>&nbsp;&nbsp;Diese Felder müssen ausgefüllt werden!
        </div>
      </div>



    </div>
  </div>



</div>

<script src="js/_msg.js"></script>
