<?php
namespace models;
use models\Model;

class Alumno extends Model{


    public function getAlumnoHorario($dni){
        $sql = "SELECT * FROM matricula WHERE id_alumno  = $dni";
        return $this->pdo->consultaTodo($sql);
    }

    public function getDatosGrafico($dni){
        $sql = "SELECT * FROM evaluacion WHERE id_alumno_nota  = $dni";
        return $this->pdo->consultaTodo($sql);

    }
    public function getDatoRecursos($email){//devuelve todos los datos de una tabla
        $sql = "SELECT * FROM recursos WHERE email_alumno = '$email' ";
       return $this->pdo->consultaTodo($sql); // devolvemos los datos con el mètodo consulta de Db

    }
}


?>