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
          'correo' => 'yickson@correo.com',
          'clave' => 'admin'
          ]
        ]);
        $data = json_decode($response->getBody(), true);
        $this->token = $data['usuario']['token'];
    }

    public function testPostLogin()
    {
      $response = $this->http->post('http://localhost/backendcts2/api/login', ['json' => [
        'correo' => 'yickson@correo.com',
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
            'nombre' => 'Anonimo',
            'correo' => 'foo@bar.com',
            'clave' => 'secreto',
            'rol' => 2
            ]
      ]);
      $this->assertEquals(200, $response->getStatusCode());

      $data = json_decode($response->getBody(), true);
      $this->assertArrayHasKey('mensaje', $data);
    }

    public function testPut()
    {
      $headers = [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept'        => 'application/json',
                 ];
      $response = $this->http->put('http://localhost/backendcts2/api/usuario/19',
      [
          'headers'         => $headers,
          'json'            => [
              'id' => 19,
              'nombre' => 'Conocido',
              'correo' => 'evolucion@correo.com',
              'rol' => 3
            ]
      ]);
      $this->assertEquals(200, $response->getStatusCode());

      $data = json_decode($response->getBody(), true);
      $this->assertArrayHasKey('mensaje', $data);
    }

    public function testDelete()
    {
      $headers = [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept'        => 'application/json',
                 ];
      $response = $this->http->delete('http://localhost/backendcts2/api/usuario/18', ['headers' => $headers]);
      $this->assertEquals(200, $response->getStatusCode());

      $data = json_decode($response->getBody(), true);
      $this->assertArrayHasKey('mensaje', $data);
    }

    public function tearDown()
    {
        $this->http = null;
    }
}
