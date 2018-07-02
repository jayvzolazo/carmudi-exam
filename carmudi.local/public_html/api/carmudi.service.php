<?php
require('config.php');

class CarsService {
  var $conn;
  var $db;

  function __construct() {
    $db = new Db();
    $this->conn = $db->connect();
  }

  function select($tname) {
    $resultsArr = [];
    $sql = 'SELECT * FROM ' . $tname;

    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      // $resultObj->total = $result->num_rows;
      $resultsArr = $result->fetch_all(MYSQLI_ASSOC);
    }
    else {
      // $resultObj->total = 0;
      // $resultObj->list = [];
      $resultsArr = [];
    }
    $this->conn->close();

    return $resultsArr;
  }

  function selectById($tname, $id) {
    $resultObj = new stdClass;

    $sql = 'SELECT * FROM ' . $tname . ' WHERE id = ' . $id;

    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      $resultObj = $result->fetch_assoc();
    }

    $this->conn->close();

    return $resultObj;
  }

  function create($tname, $data) {
    $arrData = json_decode($data, true);
    $columns = implode(', ', array_keys($arrData));
    $escValues = array_map(array($this->conn, 'real_escape_string'), $arrData);
    $values = implode('\', \'', $escValues);

    $resultObj = new stdClass;

    $sql = "INSERT INTO $tname($columns) VALUES('$values')";

    if ($this->conn->query($sql) === TRUE) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
}
