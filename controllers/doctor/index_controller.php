<?php

require_once '../../models/Doctor.php';
require_once '../../models/Schedule.php';
require_once '../../models/Appointment.php';
require_once '../../models/Patient.php';

session_start();
if (!isset($_SESSION["user"]) || ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'd')) {
    header("location: ../../login.php");
    exit();
}else{
    $userEmail = $_SESSION["user"];
}

include("../../connection.php");

$doctorModel = new DoctorModel($database);
$scheduleModel = new ScheduleModel($database);
$appointmentModel = new AppointmentModel($database);
$patientModel = new PatientModel($database);

$doctor = $doctorModel->getDoctorByEmail($userEmail);
$today = date('Y-m-d');
$nextweek = date('Y-m-d', strtotime("+1 week"));
$data = [
    'useremail' => $userEmail,
    'username' => $doctor['docname'],
    'doctorCount' => $doctorModel->getAllDoctors()->num_rows,
    'patientCount' => $patientModel->getPatientCount(),
    'appointmentCount' => $appointmentModel->getFutureAppointments($today),
    'scheduleCount' => $scheduleModel->getTodaySessionsCount($today),
    'upcomingSessions' => $scheduleModel->getUpcomingSessions($today, $nextweek)
];

include("../../views/doctor/index_view.php");
?>