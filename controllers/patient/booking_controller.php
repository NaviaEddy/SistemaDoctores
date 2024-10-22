<?php
require_once '../../models/Patient.php';
require_once '../../models/Doctor.php';
require_once '../../models/Schedule.php';
require_once '../../models/Appointment.php';

session_start();
if (!isset($_SESSION["user"]) || $_SESSION['usertype'] != 'p') {
    header("location: ../../login.php");
    exit();
}else{
    $userEmail = $_SESSION["user"];
    $idSchedule = $_GET['id'];
}

include("../../connection.php");

$patientModel = new PatientModel($database);
$doctorModel = new DoctorModel($database);
$scheduleModel = new ScheduleModel($database);
$appointmentModel = new AppointmentModel($database);
$patient = $patientModel->getPatientByEmail($userEmail);
$schedule = 
$today = date('Y-m-d');
        
$data = [
    'useremail' => $userEmail,
    'username' => $patient['pname'],
    'doctors' => $doctorModel->getAllDoctors(),
    'SessionsId' => $scheduleModel->getScheduleSessionsId($idSchedule),
    'NumbAppointents' => $appointmentModel->getNumberAppointment($idSchedule)+1 
];

include('../../views/patient/booking_view.php');
?>