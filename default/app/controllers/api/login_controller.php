<?php

/**
 * Controlador para el login
 */
class LoginController extends RestController
{

  /*
  * Login del usuario
  */
  public function post()
  {
    $datos = $this->param();
    $usuario = (New Usuarios)->login($datos);
    if(!$usuario){
      $this->data = ['err' => true, 'mensaje' => 'Datos inválidos o acceso denegado'];
    }else{
      $this->data = ['err' => false, 'usuario' => $usuario];
    }
    View::select(null, 'json');
  }
}


?>
