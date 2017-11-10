<?php

/**
 * Literatur
 * @author Karsten Berlin
 */
class Publication
{
    var $pubPKID;
    var $journalID;
    var $pubAuthors;
    var $pubYear;
    var $pubTitle;
    var $pubPages;
    var $pubVolume;
    var $pubIssue;
    var $pubLang;
    var $pubLink; /* Link zu Artikel, nicht Issue */


    const SELECTQUERY = "SELECT
                        tblPublications.pubPKID,
                        tblPublications.journalID, tblPublications.pubAuthors,
                        tblPublications.pubYear,
                        tblPublications.pubTitle, tblPublications.pubPages,
                        tblPublications.pubVolume,
                        tblPublications.pubIssue, tblPublications.pubLang,
                        tblPublications.pubLink ";

    /**
     * Fragt eine Publikation  ab.
     * @param dbmysql $pdo
     * @param String $tblPub
     * @param Integer $id
     * @return Species
     */
    static public function getPubById($pdo, $tblPub, $id) {

      $sqlQuery = self::SELECTQUERY." FROM {$tblPub}
          WHERE {$tblPub}.pubPKID  = :id ";

      $o = new Publication();

      $stmt = $pdo->prepare($sqlQuery);
      $stmt->execute(array('id' => $id));
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Publication');
      $o = $stmt->fetch();

      return $o;

    }



    /**
     * Fragt Beiträge entsprechend der Anfangsbuchstaben ab.
     * @param dbmysql $pdo
     * @param String $tblPub
     * @param String $snippet
     * @return Species
     */
    static public function getPubsBySnippet($pdo, $tblPub, $snippet)
    {
        $sqlQuery = self::SELECTQUERY." FROM {$tblPub} WHERE
                          {$tblPub}.pubTitle LIKE '%{$snippet}%'
                      ORDER BY pubAuthors ASC, pubYear DESC";
        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Publication");

        foreach($result as $o) {
          $arr[] = $o;
        }
        return $arr;
    }


    /**
     * Fragt Beiträge entsprechend der Jahrgänge ab.
     * @param dbmysql $pdo
     * @param String $tblPub
     * @param String $vol
     * @return Species
     */
    static public function getPubsByVol($pdo, $tblPub, $vol)
    {
        $sqlQuery = self::SELECTQUERY." FROM {$tblPub} WHERE
                          {$tblPub}.pubVolume LIKE '{$vol}'
                      ORDER BY pubPKID ASC";
        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Publication");

        foreach($result as $o) {
          $arr[] = $o;
        }
        return $arr;
    }


    /**
     * Fragt Beiträge der Beihefte ab.
     * Neu hinzugefuegt, weil die Beihefte nun einzeln betrachtet werden sollen
     * @param dbmysql $pdo
     * @param String $tblPub
     * @param String $vol
     * @return Species
     */
    static public function getPubsByBeiheft($pdo, $tblPub, $vol)
    {
        $sqlQuery = self::SELECTQUERY." FROM {$tblPub} WHERE
                          {$tblPub}.pubIssue LIKE '{$vol}'
                      ORDER BY pubPKID ASC";
        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Publication");

        foreach($result as $o) {
          $arr[] = $o;
        }
        return $arr;
    }



    /**
     * Fragt Beiträge entsprechend Suchbegriff in Autoren und Titel ab.
     * @param dbmysql $pdo
     * @param String $tblPub
     * @param String $snippet
     * @return Species
     */
    static public function searchPubs($pdo, $tblPub, $snippet, $srchflag) {

      switch($srchflag) {
        case "": $snippet = $snippet; break;
        case "%": $snippet = "%".$snippet; break;
        case "x%": $snippet = $snippet."%"; break;
        case "%%": $snippet = "%".$snippet."%"; break;
        default: $snippet = "%".$snippet."%"; break;
      }
        $sqlQuery = self::SELECTQUERY." FROM {$tblPub}
                      WHERE
                          ({$tblPub}.pubAuthors LIKE '{$snippet}')  OR
                          ({$tblPub}.pubTitle LIKE '{$snippet}')
                      ORDER BY pubYear DESC, pubAuthors ASC";

        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Publication");

        foreach($result as $o) {
          $arr[] = $o;
        }
        return $arr;
    }


    /**
     * Fragt Jahrgänge ab.
     * @param dbmysql $pdo
     * @param String $tblPub
     * @return Species
     */
    static public function getPubVolumes($pdo, $tblPub)
    {
        $sqlQuery = " SELECT DISTINCT {$tblPub}.pubVolume FROM {$tblPub}
                      ORDER BY pubVolume DESC ";
        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        rsort($result);
        return $result;
    }

    /**
     * Fragt Beihefte ab.
     * Neu hinzugefügt, da der Wunsch bestand, die Beihefe gesondert zu behandeln
     * @param dbmysql $pdo
     * @param String $tblPub
     * @return Species
     */
    static public function getPubBeihefte($pdo, $tblPub)
    {
        $sqlQuery = " SELECT DISTINCT {$tblPub}.pubIssue FROM {$tblPub}
                      WHERE {$tblPub}.pubVolume LIKE 'Beihefte'
                      ORDER BY {$tblPub}.pubPKID DESC ";

        $stmt = $pdo->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);

        return $result;
    }


    /**
     * Fragt Jahre zu einem Jahrgang ab und gibt es als String ('1999-2002')
     * zurueck.
     * @param dbmysql $pdo
     * @param String $tblPub
     * @param Integer $volid
     * @return Species
     */
    static public function getYearStrForVolume($pdo, $tblPub, $volid)
    {
        $sqlQuery = " SELECT DISTINCT {$tblPub}.pubYear FROM {$tblPub}
                      WHERE {$tblPub}.pubVolume LIKE '".$volid."' ORDER BY pubYear ASC ";

        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (count($result)>1) {
          $str = $result[0]."-".$result[(count($result)-1)];
        } else {
          $str = $result[0];
        }
        return $str;
    }


    /**
     * Fragt Jahre zu einem Beiheft ab und gibt es als String ('1999-2002')
     * zurueck.
     * @param dbmysql $pdo
     * @param String $tblPub
     * @param Integer $volid
     * @return Species
     */
    static public function getYearStrForBeiheft($pdo, $tblPub, $volid)
    {
        $sqlQuery = " SELECT DISTINCT {$tblPub}.pubYear FROM {$tblPub}
                      WHERE {$tblPub}.pubIssue LIKE '".$volid."' ORDER BY pubYear ASC ";

        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        if (count($result)>1) {
          $str = $result[0]."-".$result[(count($result)-1)];
        } else {
          $str = $result[0];
        }
        return $str;
    }


    /**
     * Fragt die roemische Zahl ab fuer den Dateinamen und Ordner.
     * @param Integer $nr
     * @return String
     */
    static public function getRomanEquiv($nr)
    {
        $str = "";
        $arr = array("-", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X",
                     "XI", "XII", "XIII", "XIV", "XV", "XVI", "XVII", "XVIII", "XIX", "XX",
                     "XXI", "XXII", "XXIII", "XXIV", "XXV", "XXVI", "XXVII", "XXVIII", "XXIX", "XXX",
                     "XXXI", "XXXII", "XXXIII", "XXXIV", "XXXV", "XXXVI", "XXXVII", "XXXVIII", "XXXIX", "XL",
                     "XLI", "XLII", "XLIII", "XLIV", "XLV", "XLVI", "XLVII", "XLVIII", "XLIX", "L",
                     "LI", "LII", "LIII", "LIV", "LV", "LVI", "LVII", "LVIII", "LIX", "LX",
                     "LXI", "LXII", "LXIII", "LXIV", "LXV", "LXVI", "LXVII", "LXVIII", "LXIX", "LXX",
                     "LXXI", "LXXII", "LXXIII", "LXXIV", "LXXV", "LXXVI", "LXXVII", "LXXVIII", "LXXIX", "LXXX"
                   );
        return $arr[$nr];
    }




    // Fragt die Zahl eingetragener Beiträge ab
    static public function getNrArticles($pdo, $tblPub)  {

       return $pdo->query("SELECT count(1) FROM {$tblPub}")->fetchColumn();
    }


    // Fragt die Zahl eingetragener Beiträge in Jahrgang, Issue oder Jahr ab
    static public function getNrArticlesInX($pdo, $tblPub, $viy, $val)  {

       switch($viy) {
         case "vol": $wh = " WHERE pubVolume LIKE '".$val."'"; break;
         case "issue": $wh = " WHERE pubIssue LIKE '".$val."'"; break;
         case "year": $wh = " WHERE pubYear = ".$val; break;
         case "author": $wh = " WHERE pubAuthors LIKE '%".$val."%'"; break;
       }

       return $pdo->query("SELECT count(1) FROM {$tblPub} {$wh}")->fetchColumn();
    }


}
?>
