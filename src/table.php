<?php

/**
 * @package   SQLayr
 * @version   0.4.2
 * @author    Roderic Linguri
 * @copyright 2017 Digices LLC
 * @license   MIT
 */

namespace digices\sqlayr;

abstract class Table
{

  /** @property Database **/
  protected $database;

  /** @property string **/
  protected $name;

  /** @property mixed */
  protected $columns;

  /** @property string */
  public $error;

  /** @method constructor **/
  public function __construct()
  {

  } // ./constructor

  /** @method Insert Row
    * @param  mixed (assoc)
    * @return integer (insert id)
    **/
  public function insertRow($assoc)
  {
    $keys = array();
    $values = array();
    foreach ($assoc as $k=>$v) {
      array_push($keys, $k);
      array_push($values, \digices\sqlayr\asserted_string($v));
    }
    $sql = "INSERT INTO `".$this->name."` (`".implode("`,`", $keys)."`) VALUES (".implode(",", $values).");";
    return $this->database->insert($sql);
  } // ./insertRow

  /** @method Fetch All
    * @return mixed (assoc)
    **/
  public function fetchAll() {
    $sql = "SELECT * FROM `".$this->name."`;";
    if ($res = $this->database->fetch($sql)) {
      return $res;
    } else {
      $this->error = $this->database->error;
      return false;
    }
  } // ./fetchAll

  /** @method Fetch Rows By Column
    * @param  string (column name)
    * @param  any (match value)
    * @return mixed (assoc)
    **/
  public function fetchRowsByColumn($column,$value)
  {
    $sql = "SELECT * FROM `".$this->name."` WHERE `".$column."` = '".$value."';";
    if ($res = $this->database->fetch($sql)) {
      return $res;
    } else {
      $this->error = $this->database->error;
      return false;
    }
  } // ./fetchRowsByColumn

  /** @method Fetch Row By Id
    * @param  integer (id)
    * @return mixed (assoc)
    **/
  public function fetchRowById($id)
  {
    if ($rows = $this->fetchRowsByColumn('id',$id)) {
      return $rows[0];
    } else {
      return false;
    }
  } // ./fetchRowById

  /** @method Update Rows By Column
    * @param  string (match column name)
    * @param  any (match value)
    * @param  string (set column name)
    * @param  any (set value)
    * @return mixed (assoc)
    **/
  public function updateRowsByColumn($matchColumn,$matchValue,$setColumn,$setValue)
  {
    $sql = "UPDATE `".$this->name."` SET `".$setColumn."` = '".$setValue."', updated = '".intval(date('U'))."' WHERE `".$matchColumn."` = '".$matchValue."';";
    if ($res = $this->database->execute($sql)) {
      return $res;
    } else {
      $this->error = $this->database->error;
      return false;
    }
  } // ./updateRowsByColumn

  /** @method Update Row By Id
    * @param  integer (id)
    * @param  string (set column name)
    * @param  any (set value)
    * @return mixed (assoc)
    **/
  public function updateRowById($id,$setColumn,$setValue)
  {
    return $this->updateRowsByColumn('id',$id,$setColumn,$setValue);
  } // ./updateRowById

  /** @method Delete Rows By Column
    * @param  string (column name)
    * @param  any (match value)
    * @return integer (affected rows)
    **/
  public function deleteRowsByColumn($column,$value)
  {
    $sql = "DELETE FROM `".$this->name."` WHERE `".$column."` = '".$value."';";
    if ($res = $this->database->execute($sql)) {
      return $res;
    } else {
      $this->error = $this->database->error;
      return false;
    }
  } // ./deleteRowsByColumn

  /** @method Delete Row By Id
    * @param  integer (id)
    * @return integer (affected rows)
    **/
  public function deleteRowById($id)
  {
    return $this->deleteRowsByColumn('id',$id);
  } // ./deleteRowById

} // ./Table
