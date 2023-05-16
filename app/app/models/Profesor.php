<?php
namespace models;
use models\Model;

class Profesor extends Model{

    public function getAlumnos($dia,$hora,$tipo){
        $sql = "SELECT persona.nombre, persona.apellidos, persona.email 
        FROM persona 
        JOIN matricula ON matricula.id_alumno = persona.dni 
        WHERE matricula.h_clase = '$hora' 
        AND matricula.d_clase = '$dia'
        AND matricula.t_clase = '$tipo'";
        return $this->pdo->consultaTodo($sql);
    }

   
    
}


?>