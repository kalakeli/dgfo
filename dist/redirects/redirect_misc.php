<?php
    // - redirects/redirect_misc.php
    // Verschiedene Funktionen


  // falsch hier ...
  if ( (empty($_POST)) && (empty($_GET)) ) {
      header("Location: ./../index.php"); exit;
  }



  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  //+++++  Nachricht versenden
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  if ( (!empty($_POST['sendmessage'])) && ("ok" === $_POST['sendmessage']) ) {

    $name = strip_tags(trim($_POST['name']));
    $email = strip_tags(trim($_POST['email']));
    $addr = strip_tags(trim($_POST['addr']));
    $topic = strip_tags(trim($_POST['topic']));
    $target = strip_tags(trim($_POST['target']));
    $msg = strip_tags(trim($_POST['msg']));

    $str = "";
   //
  //   // mail schicken
  //   $to = ''.$email.''; // Schreiber bekommt auch eine Nachricht zurück
   //
  //   // Subject
  //   $subject = 'Ihre Nachricht an die DGfO';
   //
  //   // Message
  //   $message = '
  //   <html>
  //   <head>
  //     <title>Nachricht an die DGfO</title>
  //   </head>
  //   <body>
  //     <h3>Vielen Dank für Ihre Nachricht an uns.</h3>
  //     <p>Liebe(r) '.$name.', <br>wir haben Ihre Nachricht erhalten und werden uns so bald wie möglich um sie kümmern. Sie haben die nachfolgenden Daten eingegeben.</p>
  //     <ul>
  //       <li><strong>Name:</strong></strong> '.$name.'</li>
  //       <li><strong>E-Mail:</strong> '.$email.'</li>
  //       <li><strong>Anschrift:</strong> '.$addr.'</li>
  //       <li><strong>Titel:</strong> '.$topic.'</li>
  //       <li><strong>Nachricht:</strong> '.$msg.'</li>
  //     </ul>
  //     <p>Vielen Dank und viele Grüße,</p>
  //     <p>&nbsp;&nbsp;&nbsp;das Team der Deutschen Gesellschaft für Orthopterologie </p>
  //   </body>
  //   </html>
  //  ';
   //
  //   // To send HTML mail, the Content-type header must be set
  //   $headers[] = 'MIME-Version: 1.0';
  //   $headers[] = 'Content-type: text/html; charset=iso-8859-1';
   //
  //   // Additional headers
  //   $headers[] = 'To: '.$name.' <'.$email.'>'; // darf kein Komma haben, sonst wird es geteilt in mehrere Empfaenger
  //   $headers[] = 'From: Deutsche Gesellschaft f. Orthopterologie <no-reply@dgfo-articulata.de>';
   //
  //   // Mail it
  //   mail($to, $subject, utf8_decode($message), implode("\r\n", $headers));


    // Nachricht an die DGfO -------------------------------------------------

    // mail schicken
    // $to = ''.$email.''; // MUSS NOCH EINGERICHTET WERDEN!!!
    $to = 'berlin@dda-web.de'; // MUSS NOCH EINGERICHTET WERDEN!!!

    // Subject
    $subject = '- '.$target.' | '.$topic.' -';

    // Message
    $message = '
    <html>
    <head>
      <title>'.$topic.'</title>
    </head>
    <body>
      <h3>Ziel der Nachricht: - '.$target.' - </h3>
      <p>Die folgende Nachricht ist über das Kontaktformular auf den Webseiten abgeschickt worden.</p>
      <ul>
        <li><strong>Name:</strong></strong> '.$name.'</li>
        <li><strong>E-Mail:</strong> '.$email.'</li>
        <li><strong>Anschrift:</strong> '.$addr.'</li>
        <li><strong>Titel:</strong> '.$topic.'</li>
        <li><strong>Nachricht:</strong> '.$msg.'</li>
      </ul>
      <p>Viele Grüße</p>
      <p>&nbsp;&nbsp;&nbsp; </p>
    </body>
    </html>
   ';

    // To send HTML mail, the Content-type header must be set
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

    // Additional headers
    $headers[] = 'To: '.$to.' <'.$to.'>'; // darf kein Komma haben, sonst wird es geteilt in mehrere Empfaenger
    $headers[] = 'From: Deutsche Gesellschaft f. Orthopterologie <no-reply@dgfo-articulata.de>';
    $headers[] = 'Cc: '.$name.' <'.$email.'>';

    // Mail it
    $ok = mail($to, $subject, utf8_decode($message), implode("\r\n", $headers));


    echo ($ok)
      ? "Vielen Dank für Ihre Nachricht! Eine Bestätigung ist an die angegebene E-Mail-Adresse gegangen"
      : "F - Das Verschicken der Nachricht ist leider fehlgeschlagen!";
    exit;
  }


?>
