<?php
include '../connection.php'; 

$id = $_GET['id'];

$sql = " SELECT p.pid, p.pemail, p.pname, p.paddress, p.pdob, 
            p.ptel, mh.allergies, mh.previous_conditions, 
            mh.current_medications, mh.family_history, mh.vaccinations, 
            mh.last_visit_date, mh.additional_notes
        FROM patient p JOIN medicalhistory mh ON p.pid = mh.pid
        WHERE p.pid = '$id'";
    
    $result = $database->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'No se encontraron datos']);
    }

?>
