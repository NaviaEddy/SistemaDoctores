<?php
include("../connection.php");

$id = $_GET['id']; 

$sql = "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, schedule.scheduletime, schedule.nop 
        FROM schedule 
        INNER JOIN doctor ON schedule.docid = doctor.docid 
        WHERE schedule.scheduleid = ?";
$stmt = $database->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$schedule = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode($schedule);
?>
