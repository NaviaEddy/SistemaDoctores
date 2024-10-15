<?php
require_once '../../models/Patient.php';
require_once '../../models/Schedule.php';

session_start();
if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'p') {
    header("location: ../../login.php");
    exit();
}else{
    $userEmail = $_SESSION["user"];
}

include("../../connection.php");

$scheduleModel = new ScheduleModel($database);
$patientModel = new PatientModel($database);

$patient = $patientModel->getPatientByEmail($userEmail);
$today = date('Y-m-d');

$data = [
    'useremail' => $userEmail,
    'username' => $patient['pname'],
    'appointments' => $scheduleModel->getAppointmentsByPatientId($patient['pid'], $today),
];
        

include('../../views/patient/appointment_view.php');
?>