<?php

/**
 * Controlador para manejar peticiones REST
 *
 * Por defecto cada acción se llama como el método usado por el cliente
 * (GET, POST, PUT, DELETE, OPTIONS, HEADERS, PURGE...)
 * ademas se puede añadir mas acciones colocando delante el nombre del método
 * seguido del nombre de la acción put_cancel, post_reset...
 *
 * @category Kumbia
 * @package Controller
 * @author kumbiaPHP Team
 */
require_once CORE_PATH . 'kumbia/kumbia_rest.php';
class RestController extends KumbiaRest {

    /**
     * Inicialización de la petición
     * ****************************************
     * Aqui debe ir la autenticación de la API
     * ****************************************
     */
    final protected function initialize() {
      if($this->module_name === 'login' || $this->controller_name === 'login') {
         return true;
      }
       // VALIDACIÓN DEL TOKEN
       $validar = Usuarios::validarToken();
       if($validar != null) {
           $this->data = ["err"=>true, "mensaje"=>$validar];
           return false; // STOP EXCECUTION
       }

    }

    final protected function finalize() {

    }

}
