<?php

/**
 * @package   SQLayr
 * @version   0.4.3
 * @author    Roderic Linguri
 * @copyright 2017 Digices LLC
 * @license   MIT
 */

namespace digices\sqlayr;

/** @function Quoted String or NULL
  * @descr    If no string, return NULL, otherwise return quoted/escaped string
  * @param    string
  * @return   string
  **/
function quoted_string_or_null($str) {
  if (strlen($str) > 0) {
    return "'".str_replace("'", "\\'", $str)."'";
  } else {
    return 'NULL';
  }
} // ./quoted_string_or_null

/** @function Asserted String
  * @descr    Make sure we at least have an empty string
  * @param    string
  * @return   string
  **/
function asserted_string($str) {
  if (strlen($str) > 0) {
    return "'".str_replace("'", "\\'", $str)."'";
  } else {
    return "''";
  }
} // ./asserted_string

/** @function Integer or NULL
  * @descr    If no integer, return NULL, otherwise return integer
  * @param    string
  * @return   string
  **/
function integer_or_null($int) {
  if (strlen($int) > 0) {
    return $int;
  } else {
    return 'NULL';
  }
}

/** @function Asserted Integer
  * @descr    If no integer, return zero, otherwise return integer
  * @param    bool | integer | string | null
  * @return   integer
  **/
function asserted_integer($int) {
  if (strlen($int) > 0) {
    return $int;
  } else {
    return 0;
  }
}