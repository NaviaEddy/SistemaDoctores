<?php
session_start();
date_default_timezone_set('Asia/Kolkata');

class SignUpController {

    public function index() {
        $_SESSION["user"] = "";
        $_SESSION["usertype"] = "";
        $_SESSION["date"] = date('Y-m-d');

        // Renderiza la vista de registro
        include('../views/signup.php');
    }

    public function handleSignUp() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION["personal"] = array(
                'fname' => $_POST['fname'],
                'lname' => $_POST['lname'],
                'address' => $_POST['address'],
                'dob' => $_POST['dob']
            );
            
            // Redirige a la página de crear cuenta
            header("location: ../../views/login/create_account_view.php");
        } else {
            // Si no hay POST, simplemente muestra el formulario
            $this->index();
        }
    }
}

// Crear una instancia del controlador y ejecutar la acción correspondiente
$controller = new SignUpController();
$controller->handleSignUp();
