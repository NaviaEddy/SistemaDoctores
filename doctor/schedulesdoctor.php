<?php
include("../connection.php");

$id = $_GET['id']; 

$sql = "SELECT * FROM schedule WHERE docid = ?";
$stmt = $database->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$schedule = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($schedule);
?>
