<?php
session_start();
include "../../connection.php";
include_once '../../models/Patient.php';
include_once '../../models/Webuser.php';

header('Content-Type: application/json');

class AccountController {
    private $patientModel;
    private $WebUserModel;
    private $error = '';
    private $url = '';

    public function __construct($database) {
        $this->patientModel = new PatientModel($database);
        $this->WebUserModel = new WebuserModel($database);
    }

    public function handleSignup($postData) {
        if ($postData) {
            $fname = $_SESSION['personal']['fname'];
            $lname = $_SESSION['personal']['lname'];
            $name = $fname . " " . $lname;
            $address = $_SESSION['personal']['address'];
            $dob = $_SESSION['personal']['dob'];
            $email = $postData['newemail'];
            $tele = $postData['tele'];
            $newpassword = $postData['newpassword'];
            $cpassword = $postData['cpassword'];

            if ($newpassword === $cpassword) {
                $result = $this->WebUserModel->getWebUserByEmail($email);
                if ($result == 1) {
                    $this->error = 'Email already registered.';
                    echo json_encode(['success' => false, 'message' => $this->error]);
                    return;
                } else {
                    $this->patientModel->createPatient($email, $name, $newpassword, $address, $dob, $tele);
                    $this->WebUserModel->createWebUser($email);
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'p';
                    $_SESSION['username'] = $fname;
                    $this->url = 'http://localhost/Online-Doctor-Appointment-System/controllers/patient/index_controller.php';
                    echo json_encode(['success' => true, 'redirect' => $this->url]);
                    return;
                }
            } else {
                $this->error = 'Password Conformation Error! Reconform Password.';
                echo json_encode(['success' => false, 'message' => $this->error]);
                return;
            }
        }
    }

    public function getError() {
        return $this->error;
    }
}

$controller = new AccountController($database);
$controller->handleSignup($_POST);
?>
