<?php
class Db {
  var $host;
  var $user;
  var $pass;
  var $dbName;
  var $conn;

  function __construct() {
    $this->host = 'localhost';
    $this->user = 'carmudi';
    $this->pass = 'carmudi';
    $this->dbName = 'carmudi';
  }

  function connect() {
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbName);

    if ($this->conn->connect_error) {
      die('Connection Failed: ' . $this->conn->connect_error);
    }

    return $this->conn;
  }

  function disconnect() {
    $this->conn->close();
  }
}
