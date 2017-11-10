<?php

/**
 * Arten im Atlas
 *
 * @author Karsten Berlin
 */
class Species
{
    var $speciesPKID;
    var $orderID;
    var $order;
    var $subOrderID;
    var $subOrder;
    var $familyID;
    var $family;
    var $subFamilyID;
    var $subFamily;
    var $genusID;
    var $genus;
    var $name_ge;
    var $name_en;
    var $name_sc;
    var $nameOrigin;
    var $type; // bei Schaben und ohrwuermern wird noch synanthrop / freilebend angegeben
    var $comment; // Kommentar steht in der evtl. verknuepften Laendertabelle

    const SELECTQUERY = "SELECT
                        tblSpecies.speciesPKID,
                        tblSpecies.orderID, tblSpecies.subOrderID,
                        tblSpecies.familyID, tblSpecies.subFamilyID,
                        tblSpecies.genusID,
                        tblSpecies.name_ge, tblSpecies.name_sc,
                        tblSpecies.name_en,
                        tblSpecies.nameOrigin,
                        tblSpecies.type";

    /**
     * Fragt eine Art mit Systematik ab.
     * @param dbmysql $pdo
     * @param String $tblSpecies
     * @param Integer $id
     * @return Species
     */
    static public function getSpeciesById($pdo, $tblSpecies, $lutSys, $id) {

      $sqlQuery = self::SELECTQUERY." FROM {$tblSpecies}
          WHERE {$tblSpecies}.speciesPKID  = :id ";

      $s = new Species();

      $stmt = $pdo->prepare($sqlQuery);
      $stmt->execute(array('id' => $id));
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Species');
      $s = $stmt->fetch();

      $s->order = Species::getTaxonomyValForId($pdo, $lutSys, $s->orderID);
      $s->subOrder = Species::getTaxonomyValForId($pdo, $lutSys, $s->subOrderID);
      $s->family = Species::getTaxonomyValForId($pdo, $lutSys, $s->familyID);
      $s->subFamily = Species::getTaxonomyValForId($pdo, $lutSys, $s->subFamilyID);
      $s->genus = Species::getTaxonomyValForId($pdo, $lutSys, $s->genusID);

      return $s;

    }

    /**
     * Fragt eine ID in der Systematik ab und gibt die umgangssprachliche Beschreibung
     * zurück.
     * @param dbmysql $pdo
     * @param String $lutSys
     * @param String $id
     * @param String $lng Sprache (wissenschaftlich oder deutsch)
     * @return String
     */
    static public function getTaxonomyValForId($pdo, $lutSys, $id, $lng="_sc") {

      $stmt = $pdo->prepare("SELECT name{$lng} FROM {$lutSys} WHERE lutPKID=?");
      $stmt->execute([$id]);
      return $stmt->fetchColumn();
    }

    /**
     * Fragt eine systematische Einheit in der Systematik ab und gibt die Werte
     * zurück.
     * <ul>
     * <li>Ordnung - 3</li>
     * <li>Unterordnung - 4</li>
     * <li>Familie - 5</li>
     * <li>Unterfamilie - 6</li>
     * <li>Gattung - 7</li>
     * </ul>
     * @param dbmysql $pdo
     * @param String $lutSys
     * @param Integer $level Level-ID (Unterordnung 4, Familie 5, Unterfamilie 6)
     * @return String
     */
    static public function getTaxonomyLevel($pdo, $lutSys, $level) {

      $stmt = $pdo->prepare("SELECT {$lutSys}.lutPKID, {$lutSys}.groupID,
            {$lutSys}.orderID, {$lutSys}.subOrderID, {$lutSys}.familyID,
            {$lutSys}.subFamilyID, {$lutSys}.name_sc, {$lutSys}.name_ge
            FROM {$lutSys} WHERE groupID=?");

      $stmt->execute([$level]);
      return $stmt->fetchAll(PDO::FETCH_GROUP);
    }


    /**
     * Fragt synanthrope Arten einer Ordnung systematisch ab und gibt die Werte
     * zurück.
     * @param dbmysql $pdo
     * @param String $lutSys
     * @param Integer $orderid
     * @return String
     */
    static public function getSynanthropeSpecies($pdo, $tblSpecies, $orderid) {

      $stmt = $pdo->prepare(self::SELECTQUERY." FROM {$tblSpecies}
          WHERE {$tblSpecies}.orderID  = {$orderid}
            AND {$tblSpecies}.type LIKE 'synanthrop'
           ORDER BY familyID ASC, subFamilyID ASC, name_sc ASC");

      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Species');
      return $stmt->fetchAll();

    }

    /**
     * Fragt freilebende Arten einer Ordnung systematisch ab und gibt die Werte
     * zurück.
     * @param dbmysql $pdo
     * @param String $lutSys
     * @param Integer $orderid
     * @return String
     */
    static public function getWildlivingSpecies($pdo, $tblSpecies, $orderid) {

      $stmt = $pdo->prepare(self::SELECTQUERY." FROM {$tblSpecies}
          WHERE {$tblSpecies}.orderID  = {$orderid}
            AND {$tblSpecies}.type LIKE 'freiland'
           ORDER BY familyID ASC, subFamilyID ASC, name_sc ASC");

      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Species');
      return $stmt->fetchAll();
    }


    /**
     * Fragt Taxonomie einer Ebene ab, bspw. alle Familien einer Unterordnung.
     * <ul>
     * <li>Ordnung - 3</li>
     * <li>Unterordnung - 4</li>
     * <li>Familie - 5</li>
     * <li>Unterfamilie - 6</li>
     * <li>Gattung - 7</li>
     * </ul>
     * @param dbmysql $pdo
     * @param String $lutSys
     * @param String $level Level-ID (Unterordnung 4, Familie 5, Unterfamilie 6)
     * @param String $leveltxt Ebene (orderID, subOrderID, familyID, subFamilyID)
     * @param Integer $id welche Unterordnung, Familie oder Unterfamilie
     * @return String
     */
    static public function getTaxonomyWithinLevel($pdo, $lutSys, $level, $leveltxt, $id) {

      $stmt = $pdo->prepare("SELECT {$lutSys}.lutPKID, {$lutSys}.groupID,
            {$lutSys}.orderID, {$lutSys}.subOrderID, {$lutSys}.familyID,
            {$lutSys}.subFamilyID, {$lutSys}.name_sc, {$lutSys}.name_ge
             FROM {$lutSys} WHERE {$lutSys}.{$leveltxt} = ?
               AND {$lutSys}.groupID = {$level}");

      $stmt->execute([$id]);
      return $stmt->fetchAll(PDO::FETCH_GROUP);
    }



    /**
     * Fragt die Arten einer taxonomischen Ebene ab.
     * @param dbmysql $pdo
     * @param String $tblSpecies
     * @param String $lutSys
     * @param String $level Level-ID (Unterordnung 4, Familie 5, Unterfamilie 6)
     * @param String $leveltxt Ebene (orderID, subOrderID, familyID, subFamilyID)
     * @return Array Species
     */
    static public function getSpeciesInTaxonomyLevel($pdo, $tblSpecies, $lutSys, $level, $leveltxt)
    {
         $sqlQuery = self::SELECTQUERY." FROM {$tblSpecies}
                       WHERE {$tblSpecies}.{$leveltxt} = {$level} ORDER BY name_sc ASC";

         $arr = array();
         $stmt = $pdo->prepare($sqlQuery);

         $stmt->execute();
         $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Species");

         foreach($result as $s)
         {
           $s->order = Species::getTaxonomyValForId($pdo, $lutSys, $s->orderID);
           $s->subOrder = Species::getTaxonomyValForId($pdo, $lutSys, $s->subOrderID);
           $s->family = Species::getTaxonomyValForId($pdo, $lutSys, $s->familyID);
           $s->subFamily = Species::getTaxonomyValForId($pdo, $lutSys, $s->subFamilyID);
           $s->genus = Species::getTaxonomyValForId($pdo, $lutSys, $s->genusID);
           $arr[] = $s;
         }
         return $arr;
    }


    /**
     * Fragt die Arten einer taxonomischen Ebene ab.
     * @param dbmysql $pdo
     * @param String $tblSpecies
     * @param String $lutSys
     * @param String $tblSubset laenderspez Tabelle mit Art-IDs
     * @param String $level Level-ID (Unterordnung 4, Familie 5, Unterfamilie 6)
     * @param String $leveltxt Ebene (orderID, subOrderID, familyID, subFamilyID)
     * @return Array Species
     */
    static public function getSpeciesSubsetInTaxonomyLevel($pdo, $tblSpecies, $lutSys, $tblSubset, $level, $leveltxt)
    {
         $sqlQuery = self::SELECTQUERY.", {$tblSubset}.comment
                       FROM {$tblSpecies} INNER JOIN {$tblSubset}
                         ON {$tblSpecies}.speciesPKID = {$tblSubset}.speciesID
                       WHERE {$tblSpecies}.{$leveltxt} = {$level} ORDER BY name_sc ASC";

         $arr = array();
         $stmt = $pdo->prepare($sqlQuery);

         $stmt->execute();
         $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Species");

         foreach($result as $s)
         {
           $s->order = Species::getTaxonomyValForId($pdo, $lutSys, $s->orderID);
           $s->subOrder = Species::getTaxonomyValForId($pdo, $lutSys, $s->subOrderID);
           $s->family = Species::getTaxonomyValForId($pdo, $lutSys, $s->familyID);
           $s->subFamily = Species::getTaxonomyValForId($pdo, $lutSys, $s->subFamilyID);
           $s->genus = Species::getTaxonomyValForId($pdo, $lutSys, $s->genusID);
           $arr[] = $s;
         }
         return $arr;
    }

    /**
     * Fragt eine Art entsprechend ihres Namens ab. Irrelevant ob der Name de,
     * en oder wissenschaftlich ist.
     * @param dbmysql $pdo
     * @param String $tblSpecies
     * @param String $name
     * @return Species
     */
    static public function getSpeciesByName($pdo, $tblSpecies, $lutSys, $name)
    {
        $sqlQuery = self::SELECTQUERY."  FROM {$tblSpecies} WHERE
                          {$tblSpecies}.name_ge LIKE '{$name}'
                       OR {$tblSpecies}.name_en LIKE '{$name}'
                       OR {$tblSpecies}.name_sc LIKE '{$name}'";

       $s = new Species();

       $stmt = $pdo->prepare($sqlQuery);
       $stmt->execute();
       $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Species");

       foreach($result as $s)
       {
         $s->order = Species::getTaxonomyValForId($pdo, $lutSys, $s->orderID);
         $s->subOrder = Species::getTaxonomyValForId($pdo, $lutSys, $s->subOrderID);
         $s->family = Species::getTaxonomyValForId($pdo, $lutSys, $s->familyID);
         $s->subFamily = Species::getTaxonomyValForId($pdo, $lutSys, $s->subFamilyID);
         $s->genus = Species::getTaxonomyValForId($pdo, $lutSys, $s->genusID);
         $arr[] = $s;
       }
       return $arr;
    }



    /**
     * Fragt Arten entsprechend der Anfangsbuchstaben ab. Irrelevant ob der Name de,
     * en oder wissenschaftlich ist. Werden in ein Array gepackt.
     * @param dbmysql $pdo
     * @param String $tblSpecies
     * @param String $snippet
     * @return Species
     */
    static public function getSpeciesBySnippet($pdo, $tblSpecies, $lutSys, $snippet)
    {
        $sqlQuery = self::SELECTQUERY." FROM {$tblSpecies} WHERE
                          {$tblSpecies}.name_ge LIKE '%{$snippet}%'
                       OR {$tblSpecies}.name_sc LIKE '%{$snippet}%'
                      ORDER BY name_ge ASC";
        $arr = array();
        $stmt = $pdo->prepare($sqlQuery);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Species");

        foreach($result as $s)
        {
          $s->order = Species::getTaxonomyValForId($pdo, $lutSys, $s->orderID);
          $s->subOrder = Species::getTaxonomyValForId($pdo, $lutSys, $s->subOrderID);
          $s->family = Species::getTaxonomyValForId($pdo, $lutSys, $s->familyID);
          $s->subFamily = Species::getTaxonomyValForId($pdo, $lutSys, $s->subFamilyID);
          $s->genus = Species::getTaxonomyValForId($pdo, $lutSys, $s->genusID);
          $arr[] = $s;
        }
        return $arr;
    }




    /**
     * Fragt die komplette Artenliste ab. Eine Sortierung kann ebenso mitgegeben
     * werden wie die Anzahl zu ladender Zeilen - als Vorsicht eingebaut f&uuml;r
     * den Fall, dass zuk&uuml;nftige Artenlisten sehr lang werden sollten.
     * @param pdo $pdo
     * @param String $tblSpecies
     * @param String $sortfld
     * @param String $sortdir
     * @param Integer $lfrom
     * @param Integer $limit
     * @return array Species
     */
    static public function getAllSpecies($pdo, $tblSpecies, $lutSys, $sortfld="name_ge", $sortdir="ASC", $lfrom=0, $limit=1000)
    {
        $sqlQuery = self::SELECTQUERY." FROM {$tblSpecies} ORDER BY
                             {$tblSpecies}.{$sortfld} {$sortdir}
                       LIMIT {$lfrom}, {$limit}";

       $arr = array();
       $stmt = $pdo->prepare($sqlQuery);

       $stmt->execute();
       $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Species");

       foreach($result as $s)
       {
         $s->order = Species::getTaxonomyValForId($pdo, $lutSys, $s->orderID);
         $s->subOrder = Species::getTaxonomyValForId($pdo, $lutSys, $s->subOrderID);
         $s->family = Species::getTaxonomyValForId($pdo, $lutSys, $s->familyID);
         $s->subFamily = Species::getTaxonomyValForId($pdo, $lutSys, $s->subFamilyID);
         $s->genus = Species::getTaxonomyValForId($pdo, $lutSys, $s->genusID);
         $arr[] = $s;
       }
       return $arr;
    }




    // Fragt die Zahl eingetragener Arten ab
    static public function getNrSpecies($pdo, $tblSpecies, $snippet="")
    {
        (strlen($snippet)>0)
            ? $wh = "WHERE ({$tblSpecies}.name_ge LIKE '%{$snippet}%')
                        OR ({$tblSpecies}.name_en LIKE '%{$snippet}%')
                        OR ({$tblSpecies}.name_sc LIKE '%{$snippet}%')"
            : $wh = "";

       return $pdo->query("SELECT count(1) FROM {$tblSpecies} {$wh}")->fetchColumn();
    }




    /**
     * Fragt die Artenliste einer taxonomischen Ebene ab. Eine Sortierung kann ebenso mitgegeben
     * werden wie die Anzahl zu ladender Zeilen - als Vorsicht eingebaut f&uuml;r
     * den Fall, dass zuk&uuml;nftige Artenlisten sehr lang werden sollten.
     * @param pdo $pdo
     * @param String $tblSpecies
     * @param String $tax Ebene (subOrder, family, sumFamily, genus)
     * @param Integer $oid
     * @param String $sortfld
     * @param String $sortdir
     * @param Integer $lfrom
     * @param Integer $limit
     * @return array Species
     */
    static public function getSpeciesByTaxId($pdo, $tblSpecies, $lutSys, $tax, $oid,
                                            $sortfld="name_ge", $sortdir="ASC",
                                            $lfrom=0, $limit=1000)  {


       $sqlQuery = self::SELECTQUERY." FROM {$tblSpecies}
                       WHERE {$tblSpecies}.{$tax}ID = :oid
                       ORDER BY {$tblSpecies}.{$sortfld} {$sortdir}
                       LIMIT {$lfrom}, {$limit}";

       $arr = array();
       $stmt = $pdo->prepare($sqlQuery);

       $stmt->execute(['oid' => $oid]);
       $result = $stmt->fetchAll(PDO::FETCH_CLASS, "Species");

       foreach($result as $s)
       {
         $s->order = Species::getTaxonomyValForId($pdo, $lutSys, $s->orderID);
         $s->subOrder = Species::getTaxonomyValForId($pdo, $lutSys, $s->subOrderID);
         $s->family = Species::getTaxonomyValForId($pdo, $lutSys, $s->familyID);
         $s->subFamily = Species::getTaxonomyValForId($pdo, $lutSys, $s->subFamilyID);
         $s->genus = Species::getTaxonomyValForId($pdo, $lutSys, $s->genusID);
         $arr[] = $s;
       }
       return $arr;
    }

}
?>
