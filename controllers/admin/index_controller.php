<?php

require_once '../../models/Patient.php';
require_once '../../models/Doctor.php';
require_once '../../models/Schedule.php';
require_once '../../models/Appointment.php';
require_once '../../models/Admin.php';

session_start();
if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'a') {
    header("location: ../../login.php");
    exit();
}else{
    $userEmail = $_SESSION["user"];
}

include("../../connection.php");

$adminModel = new AdminModel($database);
$patientModel = new PatientModel($database);
$doctorModel = new DoctorModel($database);
$scheduleModel = new ScheduleModel($database);
$appointmentModel = new AppointmentModel($database);

$admin = $adminModel->getAdminByEmail($userEmail);
$today = date('Y-m-d');
$nextweek=date("Y-m-d",strtotime("+1 week"));
        
$data = [
    'useremail' => $userEmail,
    'patientrow' => $patientModel->getPatientCount(),
    'doctorrow' => $doctorModel->getDoctorCount(),
    'appointmentrow' => $appointmentModel->getFutureAppointments($today),
    'schedulerow' => $scheduleModel->getTodaySessionsCount($today),
    'sessions' => $scheduleModel->getUpcomingSessions($today, $nextweek)->fetch_assoc(),
    'appointments' => $appointmentModel->getUpcommingAppointemts($today, $nextweek)->fetch_assoc()
];

include('../../views/admin/index_view.php');
?>
