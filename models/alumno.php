<?php

require_once "Conexion.php";

//MODELO = CONTIENE LA LÓGICA
// extends : HERENCIA (POO) en PHP
class Alumno extends Conexion{

  // Objeto que almacena la conexión que viene desde el padre (Conexion) y la compartirá con todos los métodos (CRUD+)
  private $accesoBD;

  // Constructor
  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion(); //El valor de retorno de esta funcion ha sido asignada a este objeto. Si getConexion devuelve el retorno al acceso.
  }
    // MÉTODOS PARA LISTAR, REGISTRAR Y ELIMINAR EN LA TABLA ALUMNOS
   
    // Listar
   public function listarAlumnos(){
    try {
      // 1. Preparamos la consulta
     $consulta = $this->accesoBD->prepare("CALL spu_alumnos_listar()");
     // 2. Ejecutamos la consulta
     $consulta->execute();
     // 3. Devolvemos el resultado
     return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   // Registrar
   public function registrarAlumnos($datos = []){
    try {
      // 1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_alumnos_registrar(?,?,?,?,?,?,?,?)");
      // 2. Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["apellidos"],
          $datos["nombres"], 
          $datos["dni"], 
          $datos["correo"], 
          $datos["telefono"],
          $datos["direccion"],
          $datos["nombrecarrera"],
          $datos["nivelacademico"]
        )
      );

    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   // Eliminar
   public function eliminarAlumnos($idalumno = 0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_alumnos_eliminar(?)");
      $consulta->execute(array($idalumno));
    } 
    catch (Exception $e) {
      die($e->getMessage());
    }
   }

   // Actualizar
   public function modificarAlumnos($idalumno, $datos = [])
{
    try {
        $consulta = $this->accesoBD->prepare("CALL spu_alumnos_modificar(?,?,?,?,?,?,?,?,?)");
        $consulta->execute(
            array(
                $idalumno,
                $datos["apellidos"],
                $datos["nombres"],
                $datos["dni"],
                $datos["correo"],
                $datos["telefono"],
                $datos["direccion"],
                $datos["nombrecarrera"],
                $datos["nivelacademico"]
            )
        );
    } catch (Exception $e) {
        die($e->getMessage());
    }
}





}

?>