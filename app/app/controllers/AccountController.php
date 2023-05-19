<?php
namespace app\controllers;

use models\Account;

class AccountController extends Controller{

    public function login(){
  
        if (isset($_POST['enviar'])) {
        $dni = filter_input(INPUT_POST, 'dni');
        $model=new Account;
        $res_login=$model->getAccount($dni);

       if(!empty($res_login)){ // comprobamos si el usuario existe 

        // hacemos la comprobacion si el usuario es profesor
        if ($res_login['dnia'] === null) {
            $_SESSION['nombre'] = $res_login['nombre'];
            $_SESSION['email'] = $res_login['email'];
            $_SESSION['dni'] = $res_login['dnip'];
            $_SESSION['tipo'] = $res_login['tipo'];
            $_SESSION['rol'] ="profesor";
            header("Location: views/profesor/ver.php");
          
          
        } else{ // si el usuario existe y es alumno 
            $_SESSION['nombre'] = $res_login['nombre'];
            $_SESSION['email'] = $res_login['email'];
            $_SESSION['dni'] = $res_login['dnia'];
            $_SESSION['tipo'] = $res_login['curso'];
            $_SESSION['rol'] = "alumno";
            header("Location: views/alumno/listar.php");
        }
               
    
}else{
    $_SESSION['error'] = "No estás registrado";
    
}
        }

}
    public function inicio(){
        
    }
    public function mapa(){
       
       
    }

}
?>