<?php
    namespace models;

    use vendor\core\Db;

    abstract class Model{
          protected $pdo;//para guardar la conexión
          protected $tabla; // nombre de la tabla con la que vamos a trabajar
          protected $dni;// dni de la persona alumno o profesor

          public function __construct(){//
            $this->pdo = Db::getInstancia();//guardamos la conexión a la base de datos
          }

         public function insertar($sql){ //"envoltorio" para el método ejecutar de Db
                  return $this->pdo->ejecutar($sql);
      
         }
         public function addRecurso($asignatura,$email_alumno, $recurso){
          $sql = "INSERT INTO recursos(asignatura,email_alumno, recurso) VALUES('$asignatura','$email_alumno','$recurso')";
          return $this->pdo->ejecutar($sql);
      }
         public function getTodos(){//devuelve todos los datos de una tabla
             $sql = "SELECT * FROM {$this->tabla}";
            return $this->pdo->consultaTodo($sql); // devolvemos los datos con el mètodo consulta de Db

         }
         public function getAccount($dni){
          $sql = "SELECT p.dni, p.nombre, p.apellidos, p.email, a.dnia, a.curso, a.centro, pr.dnip, pr.tipo
          FROM Persona p
          LEFT JOIN Alumno a ON p.dni = a.dnia
          LEFT JOIN Profesor pr ON p.dni = pr.dnip
          WHERE p.dni = $dni
          ";
          return $this->pdo->consulta($sql);
         }
         
    }
?>