<?php

require_once '../../models/Doctor.php';

session_start();
if (!isset($_SESSION["user"]) || ($_SESSION["user"] == "" || $_SESSION['usertype'] != 'd')) {
    header("location: ../../login.php");
    exit();
}else{
    $userEmail = $_SESSION["user"];
}

include("../../connection.php");

$doctorModel = new DoctorModel($database);

$doctor = $doctorModel->getDoctorByEmail($userEmail);
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');
$nextweek = date('Y-m-d', strtotime("+1 week"));
$data = [
    'useremail' => $userEmail,
    'username' => $doctor['docname'],
    'docid' => $doctor['docid'],
];

include("../../views/doctor/calendar_view.php");
?>