<?php
namespace app\controllers;
use models\Informacion;
use models\Profesor;

class ProfesorController extends Controller{ 

  public $datos_horario=[];

    public function ver(){
        $model =new Informacion;
         $this->datos_horario = $model->getTodos();
         // $horario_profesor = $model->getTodos();
         $nombre=$this->datos_horario;
         $this->cargarVariable(compact('nombre'));
        
         //debug($horario_profesor);
    }
    

    public function tabla_alumnos(){
// Obtener los parámetros enviados en la solicitud fetch
$dia = $_GET['dia'];
$hora = $_GET['hora'];
$tipo = $_GET['tipo'];
// Obtener los datos de los alumnos correspondientes del modelo "Profesor"
$model = new Profesor();
$alumnos = $model->getAlumnos($dia, $hora, $tipo);
header('Content-Type: application/json');
// procesamos el resultado de la consulta y lo devolvemos en formato JSON
echo json_encode($alumnos);        
    }

    public function logout(){
      session_destroy();
  }
  


  public function moveFile(){
   
    if (isset($_POST['enviar'])) {
     // si se ha seleccionado un archivo
     if(!isset($_POST['email'])){
      echo 'Debe ingresar un email';
      exit;
     }
 if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] === UPLOAD_ERR_NO_FILE) {
  // usuario no ha seleccionado ningún archivo
  $_SESSION['error_message'] = 'Debe seleccionar un archivo para subir';

  header('Location: profesor/ver');

}

//  si el archivo cumple con las restricciones de tamaño
$max_size = 1048576; //  máximo permitido en bytes 1 MB
if ($_FILES['archivo']['size'] > $max_size) {
  // excede el tamaño máximo permitido
  $_SESSION['error_message'] = 'El archivo es demasiado grande, el tamaño máximo permitido es 1 MB';
  header('Location: profesor/ver');
}

//  si el archivo cumple con las restricciones de tipo de archivo
$tipos_permitidos = array('pdf', 'doc', 'docx','txt'); // tipos permitidos
$file_tipo = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
if (!in_array($file_tipo, $tipos_permitidos)) {
  // El tipo de archivo no está permitido
  $_SESSION['error_message'] = 'El tipo de archivo no está permitido, solo se permiten archivos PDF, DOC, TXT y DOCX';
  header('Location: profesor/ver');
}

// el archivo cumple con todas las restricciones y se puede subir al servidor
$file_tmp = $_FILES['archivo']['tmp_name'];
    $file_name = $_FILES['archivo']['name'];
    $file_destination = 'app/views/alumno/' . $file_name;
    if (move_uploaded_file($file_tmp, $file_destination)) {
        // archivo se ha movido correctamente
        //  guardamos la ubicación del archivo en la base de datos
        $email_alumno = $_POST['email'];
        $asignatura = $_SESSION['tipo'];
$recurso=new Profesor;
$rec=$recurso->addRecurso($asignatura,$email_alumno,$file_destination);
$_SESSION['success_message']= "archivo se ha movido correctamente";
header('Location: profesor/ver');
    } else {
        // no se ha podido mover el archivo
        $_SESSION['error_message'] ='Error al subir el archivo ...';
        header('Location: profesor/ver');
    }
    }
}
}

?>