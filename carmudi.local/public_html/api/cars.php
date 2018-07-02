<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Custom-Header, Content-Type");
header('Content-Type: application/json');

require_once('carmudi.service.php');

class Cars {
  var $service;

  function __construct() {
    $this->service = new CarsService();
  }

  function get($id = null) {
    if ($id) {
      $result = $this->service->selectById('cars', $id);
    }
    else {
      $result = $this->service->select('cars');
    }
    return json_encode($result);
  }

  function create($params) {
    return $this->service->create('cars', $params);
  }
}

$cars = new Cars();

switch($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    if (isset($_REQUEST['id'])) {
      echo $cars->get($_REQUEST['id']);
    }
    else {
      echo $cars->get();
    }
    break;
  case 'POST':
    $reqBody = file_get_contents('php://input');
    if ($reqBody) {
      if ($cars->create($reqBody)) {
        http_response_code(201);
      }
    }
    break;
  default:
    break;
}
