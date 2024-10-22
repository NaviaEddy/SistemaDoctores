<?php
require_once '../../models/Patient.php';
require_once '../../models/Doctor.php';

session_start();
if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'p') {
    header("location: ../../login.php");
    exit();
}else{
    $userEmail = $_SESSION["user"];
}

include("../../connection.php");

$patientModel = new PatientModel($database);
$doctorModel = new DoctorModel($database);

$patient = $patientModel->getPatientByEmail($userEmail);

$data = [
    'useremail' => $userEmail,
    'username' => $patient['pname'],
    'doctorsCount' => $doctorModel->getDoctor(),
    'doctors' => $doctorModel->getAllDoctors(),
    'doctorsSpeciality' => $doctorModel->getAllDoctorsWithSpeciality()
];
        

include('../../views/patient/doctors_view.php');
?>