<?php
session_start();
include("../connection.php");

header('Content-Type: application/json');

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
        exit();
    } else {
        $useremail = $_SESSION["user"];
    }
} else {
    header("location: ../login.php");
    exit();
}

if ($_POST) {
    $sqlmain = "SELECT * FROM patient WHERE pemail=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["pid"];
    $scheduleid = $_POST['scheduleid'];

    $payment_status = "success"; 

    if ($payment_status == "success") {

        $sql = "INSERT INTO payments (pid, scheduleid, datepayment, payment_status) VALUES (?, ?, ?, 'paid')";
        $stmt = $database->prepare($sql);
        $today = date("Y-m-d H:i:s");
        $stmt->bind_param("iss", $userid, $scheduleid, $today);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]); 
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]); 
        }
        exit();
    } else {
        echo json_encode(['success' => false]); 
        exit();
    }
}
?>
