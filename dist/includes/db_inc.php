<?php
   $username = "p_appl_324la"; // Nutzer kann Eintraege machen, aendern, loeschen
   $host = "lwlzgal0.itz.lwl.org";
   $password = "gz69FHxMry";

   $databaseName = "prod_324la";

/*
 * KB-Specs
 */
   // $username = "d0268078";
   // $host = "localhost";
   // $password = "6FLstsj6!";
   // $databaseName = "d0268078";

/*
 * STRATO -> DGfO Specs
 */
   $username = "U3205343";
   $host = "rdbms.strato.de";
   $password = "6FLstsj6!";
   $databaseName = "DB3205343";


   // Seit PHP-Version 5.1 muss die locale gesetzt werden - Berlin
   date_default_timezone_set('Europe/Berlin');
   setlocale(LC_ALL, "de_DE");


   // ----- T A B E L L E N   -------------------------------------------------
   $lutSys                = "lutSystematik";    // Systematik, Ordnungen + Familien
   $tblNews               = "tblNews";                 // Nachrichten
   $tblSpecies            = "tblSpecies";       // Arten
   $tblSpeciesBB          = "tblSpeciesBB";     // Arten-Subset Berlin / Brandenburg
   $tblSpeciesNW          = "tblSpeciesNW";     // Arten-Subset NRW
   $tblSpeciesInfo        = "tblSpeciesInfo";   // zusaetzl. Infos wie Karte, Texte
   $tblSpeciesPics        = "tblSpeciesPics";   // alle Bilder zur Art
   $tblPub                = "tblPublications";            // Literatur






 ?>
