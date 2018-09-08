<?php
/**
 * Servicio REST para los usuarios
 */
class UsuarioController extends RestController
{
  /*
  * Obtener todos los usuarios
  */
  public function getAll()
  {
    $usuarios = (New Usuarios)->obtener();
    $this->data = ["err"=>false, "usuarios"=>$usuarios];
    View::select(null, 'json');
  }

  /*
  * Obtener usuario por Id
  */
  public function get($id)
  {
    $usuario = (New Usuarios)->find_by_sql("SELECT nombre, correo, rol_id FROM usuarios WHERE id = $id");
    $this->data = ["err"=>false, "usuario"=>$usuario];
    View::select(null, 'json');
  }

  /*
  * Crear un usuario
  */
  public function post()
  {
    $datos = $this->param();
    $usuario = (New Usuarios)->crear($datos);
    if($usuario){
        $this->data = ["err" => false, "mensaje" => 'Usuario creado'];
    }else{
        $this->data = ["err" => true, "mensaje" => 'Error en la creación del usuario'];
    }
    View::select(null, 'json');
  }

  /*
  * Actualizar usuario por Id
  */
  public function put($id)
  {
    $datos = $this->param();
    $usuario = (New usuarios)->editar($datos);
    if($usuario){
        $this->data = ["err" => false, "mensaje" => 'Usuario editado'];
    }else{
        $this->data = ["err" => true, "mensaje" => 'Error en la edición'];
    }
    View::select(null, 'json');
  }

  /*
  * Eliminar usuario por Id
  */
  public function delete($id)
  {
    $datos = $this->param();
    $usuario = (New Usuarios)->delete($id);
    if($usuario){
        $this->data = ["err" => false, "mensaje" => 'Usuario eliminado'];
    }else{
        $this->data = ["err" => false, "mensaje" => 'Error en la eliminación del usuario'];
    }
    View::select(null, 'json');
  }

}


?>
