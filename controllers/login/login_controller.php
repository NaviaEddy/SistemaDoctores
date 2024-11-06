<?php
session_start();
include("../../connection.php");
include("../../models/Webuser.php");
include("../../models/Patient.php");
include("../../models/Admin.php");
include("../../models/Doctor.php");

// Inicialización de variables
$email = '';
$password = '';
$error = '';

// Verifica si se envió un formulario
if ($_POST) {
    $email = $_POST['useremail'];
    $password = $_POST['userpassword'];
    $error = '<label for="promter" class="form-label"></label>';

    $userModel = new WebuserModel($database);
    $user = $userModel->getWebUserByEmail($email);

    if ($user) {
        $utype = $user['usertype'];
        if ($utype == 'p') {
            $patientModel = new PatientModel($database);
            $patient = $patientModel->validateCredentials($email, $password);
            if ($patient) {
                if ($patient['isActive'] == 1) {
                    $patientModel->updateLastConnection($email);
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'p';
                    header('location: ../patient/index_controller.php');
                } else {
                    $error = "Your account is deactivated, please contact technical support.";
                }
            } else {
                $error = "Wrong credentials: Invalid email or password.";
            }
        } elseif ($utype == 'a') {
            $adminModel = new AdminModel($database);
            $admin = $adminModel->validateCredentials($email, $password);
            if ($admin) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'a';
                header('location: ../../admin/index.php');
            } else {
                $error = "Wrong credentials: Invalid email or password.";
            }
        } elseif ($utype == 'd') {
            $doctorModel = new DoctorModel($database);
            $doctor = $doctorModel->validateCredentials($email, $password);
            if ($doctor) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'd';
                header('location: ../doctor/index_controller.php');
            } else {
                $error = "Wrong credentials: Invalid email or password.";
            }
        }
    } else {
        $error = "We can't find any account with this email.";
    }
}

include("../../views/login/index_view.php");
?>
