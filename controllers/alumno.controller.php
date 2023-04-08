<?php

require_once '../models/Alumno.php';

if(isset($_POST['operacion'])){

  $alumno = new Alumno();

  // OPERACION listar
  if($_POST['operacion'] == 'listar'){

    $datosObtenidos = $alumno->listarAlumnos();

    // PASO 1: Verificar que el objeto contenga datos
    if($datosObtenidos){
      $numeroFila = 1;
      // PASO 2. Recorrer todo el objeto
      foreach($datosObtenidos as $alumno){ // INICIO DEL FOREACH
        // PASO 3: Ahora construimos las filas
        echo "
          <tr>
            <td>{$numeroFila}</td>
            <td>{$alumno['apellidos']}</td>
            <td>{$alumno['nombres']}</td>
            <td>{$alumno['dni']}</td>
            <td>{$alumno['correo']}</td>
            <td>{$alumno['telefono']}</td>
            <td>{$alumno['direccion']}</td>
            <td>{$alumno['nombrecarrera']}</td>
            <td>{$alumno['nivelacademico']}</td>
            <td>
                <a href='#' data-idalumno='{$alumno['idalumno']}' class='btn btn-danger btn-sm eliminar'><i class='fa-solid fa-trash-can'></i></a>
                <a href='#' data-idalumno='{$alumno['idalumno']}' class='btn btn-info btn-sm editar'><i class='fa-solid fa-pencil'></i></a>
            </td>
          </tr>
        ";
          $numeroFila++;
      } // FIN DEL FOREACH
    }

  }

  // OPERACION registrar
  if($_POST['operacion'] == 'registrar') {

    // PAso 1: Recopilando los datos que la vista nos envía (FROM, utilizando AJAX)
    // $_POST: Esto es lo que se nos envía desde FORMULARIO (Modal)
    $datosForm = [
      'apellidos'             => $_POST['apellidos'],
      'nombres'               => $_POST['nombres'],
      'dni'                   => $_POST['dni'],
      'correo'                => $_POST['correo'],
      'telefono'              => $_POST['telefono'],
      'direccion'             => $_POST['direccion'],
      'nombrecarrera'         => $_POST['nombrecarrera'],
      'nivelacademico'        => $_POST['nivelacademico']
    ];

    // Paso 2: Enviar el arreglo como parámetro del método registrar
    $alumno->registrarAlumnos($datosForm);

  }

  // CREANDO LA OPCION DE MODIFICAR (UPDATE)
  if($_POST['operacion'] == 'modificar') {
    // Paso 1: Recopilando los datos que la vista nos envía (FROM, utilizando AJAX)
    // $_POST: Esto es lo que se nos envía desde FORMULARIO (Modal)
    $idalumno = $_POST['idalumno'];
    $datosForm = [
        'apellidos'       => $_POST['apellidos'],
        'nombres'         => $_POST['nombres'],
        'dni'             => $_POST['dni'],
        'correo'          => $_POST['correo'],
        'telefono'        => $_POST['telefono'],
        'direccion'       => $_POST['direccion'],
        'nombrecarrera'   => $_POST['nombrecarrera'],
        'nivelacademico'  => $_POST['nivelacademico']
    ];
    // Paso 2: Enviar los datos como parámetros separados del método modificar
    $alumno->modificarAlumnos($idalumno, $datosForm);
}

  if($_POST['operacion'] == 'eliminar'){
    $alumno->eliminarAlumnos($_POST['idalumno']);
  }

}