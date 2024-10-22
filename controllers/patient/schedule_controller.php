<?php

require_once '../../models/Patient.php';
require_once '../../models/Doctor.php';
require_once '../../models/Schedule.php';

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
$scheduleModel = new ScheduleModel($database);

$patient = $patientModel->getPatientByEmail($userEmail);
$today = date('Y-m-d');
        
$data = [
    'useremail' => $userEmail,
    'username' => $patient['pname'],
    'doctors' => $doctorModel->getAllDoctors(),
    'Sessions' => $scheduleModel->getScheduleSessionsToday($today),
];

include('../../views/patient/schedule_view.php');
?>
