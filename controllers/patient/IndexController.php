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
    'patientCount' => $patientModel->getPatientCount(),
    'doctors' => $doctorModel->getAllDoctors(),
    'doctorCount' => $doctorModel->getDoctorCount(),
    'todaySessions' => $scheduleModel->getTodaySessionsCount($today),
    'appointments' => $scheduleModel->getAppointmentsByPatientId($patient['pid'], $today),
    'futureAppointments' => $scheduleModel->getFutureAppointments($today)
];

include('../../views/patient/index_view.php');
?>
