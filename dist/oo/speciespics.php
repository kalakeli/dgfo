<?php

/**
 * Artbilder im Atlas
 *
 * @author Karsten Berlin
 */
class SpeciesPic {
  var $spPKID;
  var $speciesID;
  var $picText;
  var $pic;
  var $picSrc;
  var $dateAdded;

  const SELECTQUERY = "SELECT
                      tblSpeciesPics.spPKID,
                      tblSpeciesPics.speciesID, tblSpeciesPics.picText,
                      tblSpeciesPics.pic, tblSpeciesPics.picSrc,
                      tblSpeciesPics.dateAdded
                      ";

  /**
   * Fragt ein Art-Bild ab.
   * @param dbmysql $pdo
   * @param String $tblSpeciesPics
   * @param Integer $id
   * @return SpeciesPic
   */
  static public function getPicById($pdo, $tblSpeciesPics,  $id) {

    $sqlQuery = self::SELECTQUERY." FROM {$tblSpeciesPics}
        WHERE {$tblSpeciesPics}.spPKID  = :id ";

    $s = new Species();

    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute(array('id' => $id));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'SpeciesPic');
    $s = $stmt->fetch();

    return $s;
  }


  /**
   * Fragt ein Zufallsbild ab.
   * @param dbmysql $pdo
   * @param String $tblSpeciesPics
   * @return SpeciesPic
   */
  static public function getRandomPic($pdo, $tblSpeciesPics) {

    $arr = SpeciesPic::getKeys($pdo, $tblSpeciesPics);
    $randNr = rand(0, count($arr)-1);

    $sqlQuery = self::SELECTQUERY." FROM {$tblSpeciesPics}
        WHERE {$tblSpeciesPics}.spPKID  = ".$arr[$randNr]." ";

    $s = new Species();

    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'SpeciesPic');
    $s = $stmt->fetch();

    return $s;
  }



  /**
   * Fragt  ab.
   * @param dbmysql $pdo
   * @param String $tblNews
   * @return Integer
   */
  static public function getKeys($pdo, $tblSpeciesPics)
  {
    return $pdo->query("SELECT {$tblSpeciesPics}.spPKID FROM {$tblSpeciesPics}")->fetchAll(PDO::FETCH_COLUMN);
  }




  /**
   * Fragt alle Bilder einer Art ab
   * @param dbmysql $pdo
   * @param String $tblSpeciesPics
   * @param Integer $id
   * @return SpeciesPic
   */
  static public function getPicsBySpeciesId($pdo, $tblSpeciesPics,  $id) {

    $sqlQuery = self::SELECTQUERY." FROM {$tblSpeciesPics}
        WHERE {$tblSpeciesPics}.speciesID  = :id ";

    $arr = array();
    $stmt = $pdo->prepare($sqlQuery);

    $stmt->execute(array('id' => $id));
    $result = $stmt->fetchAll(PDO::FETCH_CLASS, "SpeciesPic");

    foreach($result as $s)
    {
      $arr[] = $s;
    }
    return $arr;

  }
}
?>
