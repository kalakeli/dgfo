<?php

/**
 * Arten im Atlas
 *
 * @author Karsten Berlin
 */
class SpeciesInfo {
  var $siPKID;
  var $speciesID;
  var $speciesText;
  var $mapPath;
  var $mapInfo;
  var $mapSrc;
  var $mainPic;
  var $mainPicSrc;
  var $mainPicText;
  var $osfID;
  var $gbifID;
  var $systaxID;
  var $dateAdded;

  const SELECTQUERY = "SELECT
                      tblSpeciesInfo.siPKID,
                      tblSpeciesInfo.speciesID, tblSpeciesInfo.speciesText,
                      tblSpeciesInfo.mapPath, tblSpeciesInfo.mapInfo,
                      tblSpeciesInfo.mapSrc,
                      tblSpeciesInfo.mainPic, tblSpeciesInfo.mainPicSrc,
                      tblSpeciesInfo.mainPicText,
                      tblSpeciesInfo.osfID, tblSpeciesInfo.gbifID,
                      tblSpeciesInfo.systaxID, tblSpeciesInfo.dateAdded
                      ";

  /**
   * Fragt eine Art-Info ab.
   * @param dbmysql $pdo
   * @param String $tblSpeciesInfo
   * @param Integer $id
   * @return Species
   */
  static public function getInfoById($pdo, $tblSpeciesInfo,  $id) {

    $sqlQuery = self::SELECTQUERY." FROM {$tblSpeciesInfo}
        WHERE {$tblSpeciesInfo}.siPKID  = :id ";

    $s = new Species();

    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute(array('id' => $id));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'SpeciesInfo');
    $s = $stmt->fetch();

    return $s;

  }

  /**
   * Fragt eine Art-Info entsprechend der Art-ID ab.
   * @param dbmysql $pdo
   * @param String $tblSpeciesInfo
   * @param Integer $id
   * @return Species
   */
  static public function getInfoBySpeciesId($pdo, $tblSpeciesInfo,  $id) {

    $sqlQuery = self::SELECTQUERY." FROM {$tblSpeciesInfo}
        WHERE {$tblSpeciesInfo}.speciesID  = :id ";

    $s = new Species();

    $stmt = $pdo->prepare($sqlQuery);
    $stmt->execute(array('id' => $id));
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'SpeciesInfo');
    $s = $stmt->fetch();

    return $s;

  }
}
?>
