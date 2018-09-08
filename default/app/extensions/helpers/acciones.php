<?php
/**
 * Clase agregar botones a la tabla datatable
 * @category   Kumbia
 * @package    BtnAcciones
 */
class Acciones
{

    public static function btnUsuario($id)
    {
      $btn = "<button value='$id' class='btn btn-primary editar' data-toggle='modal' data-target='#editar'><i class='fa fa-edit'></i></button>
              <button value='$id' class='btn btn-danger eliminar'><i class='fa fa-trash'></i></button>";
      return $btn;
    }
}
