<?php
  // deutschsprachige navigation
?>

<div class="hamburger">
  <button type="button" class="btn btn-default">
    <i class="fa fa-2x fa-bars" aria-hidden="true"></i>
  </button>
</div>

<nav class="navigation">
<!-- <nav class="navigation"> -->
  <div class="secondlevel" id="secondnav">
    <p class="text-center">
      <i class="fa fa-2x fa-times" aria-hidden="true" id="closemenu"></i>
    </p>
    <div id="secondul"></div>
  </div>
  <ul>
    <li>
      <div class="menubar">
        &nbsp;
      </div>
      <figure>
        <a href="./">
          <h2>DGfO</h2>
        </a>
      </figure>
<?php
  if ( ($lang == "ge") || ($lang == "de") ) {
      echo "<figure>
               <img src='images/icon_engl.png' title='switch to english' onclick=\"switchLang('en');\" class='lngchanger' alt='news icon' class='img-responsive img-rounded'>
            </figure>";
  } else {
    echo "<figure>
            <a href='#'>
              <img src='images/icon_german.png' title='die deutsche Version anzeigen' onclick=\"switchLang('de');\" class='lngchanger' alt='news icon' class='img-responsive img-rounded'>
            </a>
          </figure>";
  }
?>

    </li>
    <li>
      <div class="menubar">
        &nbsp;
      </div>
      <figure>
        <a href="./aktuelles" <?php echo ($_GET["top"]=="aktuelles") ? "class='active'" : ""; ?>>
          <img src="images/menu/news_fff.png" class="navicon" alt="news icon" class="img-responsive">
          <figcaption>
            <?php echo ( ($lang == "ge") || ($lang == "de") ) ? "Aktuelles" : "News"; ?>
          </figcaption>
        </a>
      </figure>
    </li>
    <li>
      <div class="menubar">
        &nbsp;
      </div>
      <figure>
        <a href="./dgfo" <?php echo ($_GET["top"]=="dgfo") ? "class='active'" : ""; ?>>
          <img src="images/menu/aboutus_fff.png" class="navicon" alt="about us icon" class="img-responsive">
          <figcaption>
            <?php echo ( ($lang == "ge") || ($lang == "de") ) ? "Wir über uns" : "About us"; ?>
          </figcaption>
        </a>
      </figure>
    </li>
    <li>
      <div class="menubar">
        &nbsp;
      </div>
      <figure>
        <a href="./mitgliedschaft" <?php echo ($_GET["top"]=="mitgliedschaft") ? "class='active'" : ""; ?>>
          <img src="images/menu/membership_fff.png" class="navicon" alt="membership icon" class="img-responsive">
          <figcaption>
            <?php echo ( ($lang == "ge") || ($lang == "de") ) ? "Mitgliedschaft" : "Membership"; ?>
          </figcaption>
        </a>
      </figure>
    </li>
    <li>
      <div class="menubar">
        &nbsp;
      </div>
      <figure>
        <a href="./forschungsfoerderung" <?php echo ($_GET["top"]=="forschungsfoerderung") ? "class='active'" : ""; ?>>
          <img src="images/menu/idea_money_fff.png" class="navicon" alt="forschungsfoerderung icon" class="img-responsive">
          <figcaption>
            <?php echo ( ($lang == "ge") || ($lang == "de") ) ? "Forschungs-<br>förderung" : "Research<br>funding"; ?>
          </figcaption>
        </a>
      </figure>
    </li>
    <li>
      <div class="menubar">
        <!-- <a href="#" onclick="event.preventDefault(); sh('articulata');">+</a> -->
      </div>
      <figure>
        <a href="./articulata" <?php echo ($_GET["top"]=="articulata") ? "class='active'" : ""; ?>>
          <img src="images/menu/publication_fff.png" class="navicon" alt="publication icon" class="img-responsive">
          <figcaption>
            ARTICULATA
          </figcaption>
        </a>
      </figure>
    </li>
    <li>
      <div class="menubar">
        &nbsp;
      </div>
      <figure>
        <a href="./heuschrecken" <?php echo ($_GET["top"]=="heuschrecken") ? "class='active'" : ""; ?>>
          <img src="images/menu/grasshopper_fff.png" class="navicon" alt="grasshopper icon" class="img-responsive">
          <figcaption>
            <?php echo ( ($lang == "ge") || ($lang == "de") ) ? "Heuschrecken <br>Fangschrecken" : "Orthoptera<br>Mantidae"; ?>
          </figcaption>
        </a>
      </figure>
    </li>
    <li>
      <div class="menubar">
        &nbsp;
      </div>
      <figure>
        <a href="./schaben" <?php echo ($_GET["top"]=="schaben") ? "class='active'" : ""; ?>>
          <img src="images/menu/cockroach_fff.png" class="navicon" alt="cockroach icon" class="img-responsive">
          <figcaption>
            <?php echo ( ($lang == "ge") || ($lang == "de") ) ? "Schaben <br>Ohrwürmer" : "Blattodea<br>Dermaptera"; ?>

          </figcaption>
        </a>
      </figure>
    </li>
    <li>
      <div class="menubar">
        &nbsp;
      </div>
      <figure>
        <a href="./kontakt" <?php echo ($_GET["top"]=="kontakt") ? "class='active'" : ""; ?>>
          <img src="images/menu/contact_fff.png" class="navicon" alt="contact icon" class="img-responsive">
          <figcaption>
            <?php echo ( ($lang == "ge") || ($lang == "de") ) ? "Kontakt" : "Contact"; ?>
          </figcaption>
        </a>
      </figure>
    </li>
  </ul>
</nav>

<script>

function sh(topic) {
  var tops, i, li, a, txt;

  $(".navigation").animate({"left":"0px"}, 300);
  $(".page-wrap").animate({"margin-left":"475px"}, 300);
  $(".header").animate({"margin-left":"475px"}, 300);

  switch(topic) {
    case "aktuelles":
      tops = menu.aktuelles;
      break;
    case "dgfo":
      tops = menu.dgfo;
      break;
    case "articulata":
      tops = menu.articulata;
      break;
    case "heuschrecken":
      tops = menu.heuschrecken;
      break;
    case "schaben":
      tops = menu.schaben;
      break;
    case "ohrwuermer":
      tops = menu.ohrwuermer;
      break;
  }
  $("#secondul").html("");

  var urlStr = window.location.href;

  for (i=0; i<tops.length; i++) {
    li = document.createElement("LI");
    if (urlStr.indexOf(tops[i].link.substr(1))>0) {
      li.className="active";
    }
    a = document.createElement("a");
    txt = document.createTextNode(tops[i].title);
    a.appendChild(txt);
    a.title = tops[i].title;
    a.href = tops[i].link;
    li.appendChild(a);
    document.getElementById('secondul').appendChild(li);
    // console.log(tops[i].link);
  }

}

$(document).ready(function() {
  // Artenabfrage
  $('#closemenu').click(function() {
    $(".navigation").animate({"left":["-300px", "swing"]}, 300);
    $(".page-wrap").animate({"margin-left":"175px"}, 300);
    $(".header").animate({"margin-left":"150px"}, 300);
  });
});
</script>
