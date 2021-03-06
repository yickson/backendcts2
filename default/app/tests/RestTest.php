<?php
require_once '../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;

class RestTest extends TestCase
{

    private $http;
    var $token;

    public function setUp()
    {
        $this->http = new GuzzleHttp\Client(['base_uri' => 'http://localhost/backendcts2/api/usuario']);
        $response = $this->http->post('http://localhost/backendcts2/api/login', ['json' => [
          'correo' => 'admin@admin.com',
          'clave' => 'admin'
          ]
        ]);
        $data = json_decode($response->getBody(), true);
        $this->token = $data['usuario']['token'];
    }

    public function testPostLogin()
    {
      $response = $this->http->post('http://localhost/backendcts2/api/login', ['json' => [
        'correo' => 'admin@admin.com',
        'clave' => 'admin'
        ]
      ]);
      $this->assertEquals(200, $response->getStatusCode());

      $data = json_decode($response->getBody(), true);
      $this->assertArrayHasKey('usuario', $data);
    }

    public function testGet()
    {
        $headers = [
                      'Authorization' => 'Bearer ' . $this->token,
                      'Accept'        => 'application/json',
                   ];
        $response = $this->http->request('GET', '', [
            'headers' => $headers
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('usuarios', $data);
    }

    public function testPost()
    {
      $headers = [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept'        => 'application/json',
                 ];
      $response = $this->http->post('', [
          'headers'         => $headers,
          'json'            => [
            'nombre' => 'Guillermo Castro',
            'correo' => 'guillermo@correo.com',
            'clave' => '123456',
            'rol' => 2
            ]
      ]);
      $this->assertEquals(200, $response->getStatusCode());

      $contentType = $response->getHeaders()["Content-Type"][0];
      $this->assertEquals("application/json", $contentType);

      $data = json_decode($response->getBody(), true);
      $this->assertArrayHasKey('mensaje', $data);
    }

    public function testPut()
    {
      $headers = [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept'        => 'application/json',
                 ];
      $response = $this->http->put('http://localhost/backendcts2/api/usuario/2',
      [
          'headers'         => $headers,
          'json'            => [
              'id' => 2,
              'nombre' => 'Angelica Herrera',
              'correo' => 'angelica@correo.com',
              'rol' => 3
            ]
      ]);
      $this->assertEquals(200, $response->getStatusCode());

      $contentType = $response->getHeaders()["Content-Type"][0];
      $this->assertEquals("application/json", $contentType);

      $data = json_decode($response->getBody(), true);
      $this->assertArrayHasKey('mensaje', $data);
    }

    public function testDelete()
    {
      $headers = [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept'        => 'application/json',
                 ];
      $response = $this->http->delete('http://localhost/backendcts2/api/usuario/3', ['headers' => $headers]);
      $this->assertEquals(200, $response->getStatusCode());

      $contentType = $response->getHeaders()["Content-Type"][0];
      $this->assertEquals("application/json", $contentType);

      $data = json_decode($response->getBody(), true);
      $this->assertArrayHasKey('mensaje', $data);
    }

    public function tearDown()
    {
        $this->http = null;
    }
}
