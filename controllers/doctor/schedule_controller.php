<?php

require_once '../../models/Doctor.php';
require_once '../../models/Schedule.php';

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

$doctor = $doctorModel->getDoctorByEmail($userEmail);
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$nextweek = date('Y-m-d', strtotime("+1 week"));
$data = [
    'useremail' => $userEmail,
    'username' => $doctor['docname'],
    'appointmentCount' => $scheduleModel->getSchedulesSessionsDoctorCount($doctor['docid']),
    'appointments' => $scheduleModel->getSchedulesSessionsDoctor($doctor['docid']),
];

include("../../views/doctor/schedule_view.php");
?>