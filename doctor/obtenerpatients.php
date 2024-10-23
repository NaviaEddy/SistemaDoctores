<?php
include("../connection.php");

$id = $_GET['id']; 

$sql = "SELECT appointment.apponum, patient.pid, patient.pname, patient.ptel 
        FROM appointment 
        INNER JOIN patient ON patient.pid = appointment.pid 
        INNER JOIN schedule ON schedule.scheduleid = appointment.scheduleid 
        WHERE schedule.scheduleid = ?";
$stmt = $database->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$patients = [];
while ($row = $result->fetch_assoc()) {
    $patients[] = $row;
}

header('Content-Type: application/json');
echo json_encode($patients);
?>
