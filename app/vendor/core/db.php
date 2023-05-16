<?php
namespace vendor\core;

use PDO;

class Db{
 
    protected $pdo;
    protected static $instancia;

        protected function __construct(){
            $db = require WWW ."\\app\\bd\\config_bd.php";
            $this->pdo = new PDO($db['dsn'],$db['user'],$db['pass']);
        }

        public static function getInstancia(){
             if (self::$instancia === null) {// si no hay ninguna instancia de un objeto
                self::$instancia=new self;// creamos la instancia de este clase
                                            }
                        return self::$instancia;
         }

         public function ejecutar($sql){//método para la consulta de tipo inserción/create table.por parámetro le pasamos la consulta 
             $stmt = $this->pdo->prepare($sql);
                        return $stmt->execute();//devuelve si ha tenido éxito la consulta(true o false)
         }

        public function consulta($sql){//método para la consulta de tipo SELECT
            $stmt = $this->pdo->prepare($sql);
            $res = $stmt->execute();
            if ($res) {//si hay datos 
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
           return [];//si $res=false, es decir no hay datos entonces devolvemos array vacío 


        }

        public function consultaTodo($sql){//método para la consulta de tipo SELECT *
            $stmt = $this->pdo->prepare($sql);
            $res = $stmt->execute();
            if ($res) {//si hay datos 
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
           return [];//si $res=false, es decir no hay datos entonces devolvemos array vacío 

        }
}

?>