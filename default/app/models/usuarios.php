<?php
require_once APP_PATH ."extensions/helpers/acciones.php";
/**
 * Modelo de usuarios
 */
class Usuarios extends ActiveRecord
{

  public function obtener()
  {
    $datos = array();
    $i = 0;
    $usuarios = $this->find_all_by_sql("SELECT id, nombre, correo, rol_id FROM usuarios");
    foreach ($usuarios as $usuario) {
      $datos[$i]['nombre'] = $usuario->nombre;
      $datos[$i]['correo'] = $usuario->correo;
      $datos[$i]['rol'] = (New Roles)->find($usuario->rol_id)->tipo;
      $datos[$i]['acciones'] = Acciones::btnUsuario($usuario->id);

      $i++;
    }
    return $datos;
  }
  /*
  * Recibe datos
  * @param array
  * @return boolean
  */
  public function crear($datos)
  {
    $usuario = (New Usuarios);
    $usuario->nombre = $datos['nombre'];
    $usuario->correo = $datos['correo'];
    $usuario->clave = $datos['clave'];
    $usuario->rol_id = $datos['rol'];

    if($usuario->save()){
      return true;
    }else{
      return false;
    }
  }

  public function editar($datos)
  {
    $id = $datos['id'];
    $usuario = $this->find($id);
    $usuario->nombre = $datos['nombre'];
    $usuario->correo = $datos['correo'];
    $usuario->rol_id = $datos['rol'];
    if($usuario->save()){
      return true;
    }else{
      return false;
    }
  }

  public function login($datos)
  {
    $correo = $datos['correo'];
    $clave = $datos['clave'];
    $u = $this->exists("correo = '$correo' AND clave='$clave'");
    if($u){
      //Acá genera el token
      $usuario = $this->find_by_correo("$correo");
      $token = Auth::SignIn([
        'id' => $usuario->id,
        'name' => $usuario->nombre
      ]);
      return ["usuario"=>$usuario, "token"=>$token];
    }else{
      return false;
    }
  }

  public function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
    /**
     * get access token from header
     * */
    public function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public static function validarToken()
    {
      try {
        $token = (New Usuarios)->getBearerToken();
        $validar = Auth::check($token);
      } catch (Exception $e) {
        return $e->getMessage();
      }
      //return $validar;
    }

    public static function getToken()
    {
      $token = (New Usuarios)->getBearerToken();
      return Auth::getData($token);
    }
}


?>
