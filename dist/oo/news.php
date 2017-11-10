<?php

/**
 * Aktuelle Meldungen
 *
 * @author Karsten Berlin
 */
class News
{
    var $newsPKID;
    var $newsTitle;
    var $newsText;
    var $newsDate;


    const SELECTQUERY = "SELECT
                        tblNews.newsPKID,
                        tblNews.newsTitle, tblNews.newsText,
                        tblNews.newsDate ";

    /**
     * Fragt eine Nachricht ab.
     * @param dbmysql $pdo
     * @param String $tblNews
     * @param Integer $id
     * @return News
     */
    static public function getNewsById($pdo, $tblNews, $id) {

      $sqlQuery = self::SELECTQUERY." FROM {$tblNews}
          WHERE {$tblNews}.newsPKID  = :id ";

      $s = new News();

      $stmt = $pdo->prepare($sqlQuery);
      $stmt->execute(array('id' => $id));
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'News');
      $s = $stmt->fetch();

      return $s;

    }






    /**
     * Fragt x Nachrichten ab.
     * @param dbmysql $pdo
     * @param String $tblNews
     * @param Integer $nr
     * @return News
     */
    static public function getLastXNews($pdo, $tblNews, $nr)
    {
        $sqlQuery = self::SELECTQUERY." FROM {$tblNews}
                      ORDER BY {$tblNews}.newsDate DESC
                      LIMIT 0, {$nr}";

        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "News");

        foreach($result as $s) {
          $arr[] = $s;
        }
        return $arr;
    }


    /**
     * Fragt Anzahl der Nachrichten ab.
     * @param dbmysql $pdo
     * @param String $tblNews
     * @return Integer
     */
    static public function getNewsNr($pdo, $tblNews)
    {
      return $pdo->query("SELECT count(1) FROM {$tblNews}")->fetchColumn();
    }


    /**
     * Fragt Nachrichten in Zeitraum ab.
     * @param dbmysql $pdo
     * @param String $tblNews
     * @param String $ds
     * @param String $de
     * @return News
     */
    static public function getNewsBetween($pdo, $tblNews, $ds, $de)
    {
        $sqlQuery = self::SELECTQUERY." FROM {$tblNews}
                      WHERE {$tblNews}.newsDate >= '".$ds."'
                        AND {$tblNews}.newsDate <= '".$de."'
                      ORDER BY {$tblNews}.newsDate DESC ";

        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "News");

        foreach($result as $s) {
          $arr[] = $s;
        }
        return $arr;
    }


    /**
     * Fragt Jahre absteigend ab.
     * @param dbmysql $pdo
     * @param String $tblNews
     * @return Array Integer
     */
    static public function getNewsYears($pdo, $tblNews)
    {
        $sqlQuery = "SELECT DISTINCT YEAR(newsDate) as jahr FROM `tblNews` ORDER BY jahr desc";

        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


}
?>
