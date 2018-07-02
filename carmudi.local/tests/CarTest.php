<?php
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase {
    private $http;

    public function setUp() {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://localhost']);
    }

    public function testCarList() {
        $response = $this->http->request('GET', 'api/cars');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $body = json_decode($response->getBody(), TRUE);

        $this->assertArrayHasKey("name", $body[0]);
        $this->assertArrayHasKey("engineDisp", $body[0]);
        $this->assertArrayHasKey("enginePower", $body[0]);
        $this->assertArrayHasKey("price", $body[0]);
        $this->assertArrayHasKey("location", $body[0]);
    }

    public function testCarCreate() {
      $stream = GuzzleHttp\Psr7\stream_for('
        {
          "name":"YamahaX 2",
          "engineDisp":"157",
          "enginePower":"50000",
          "price":"120000",
          "location":"laguna"
        }'
      );
      $response = $this->http->request('POST', 'api/cars', ['body' => $stream]);

      $this->assertEquals(201, $response->getStatusCode());
    }

    public function tearDown() {
        $this->http = null;
    }
}
