<?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }
    }else{
        header("location: ../login.php");
    }

    if ($_GET) {
        include("../connection.php");
        
        $id = $_GET["id"];
        
        $sql = "DELETE FROM appointment WHERE appoid = ?";
        $stmt = $database->prepare($sql); 
        if ($stmt) {
            $stmt->bind_param("i", $id);  
        
            $stmt->execute();
        
            header("location: appointment.php");
            exit();
        } else {
            echo "Error al preparar la consulta SQL.";
        }
    }
?>
