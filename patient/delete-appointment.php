<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../libs/PHPMailer/src/Exception.php';
require_once '../libs/PHPMailer/src/PHPMailer.php';
require_once '../libs/PHPMailer/src/SMTP.php';

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'p') {
        header("location: ../login.php");
    }
} else {
    header("location: ../login.php");
}

if ($_GET) {
    include("../connection.php");

    $idappo = $_GET["id"];
    $docid = $_GET["docid"];  
    $schid = $_GET["schid"]; 

    $sql = "SELECT docemail FROM doctor WHERE docid = ?";
    $stmt = $database->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $docid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $doctor_email = $row['docemail'];

            $sql2 = "SELECT scheduletime FROM schedule WHERE scheduleid = ?";
            $stmt2 = $database->prepare($sql2);
            if ($stmt2) {
                $stmt2->bind_param("i", $schid);
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                if ($result2->num_rows > 0) {
                    $row2 = $result2->fetch_assoc();
                    $schedule_time = $row2['scheduletime'];

                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host       = 'smtp.gmail.com'; 
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'edocsistema@gmail.com'; 
                        $mail->Password   = 'oiuyxkdrbewxbzvp'; 
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port       = 587;

                        $mail->setFrom('edocsistema@gmail.com', 'Edoc Sistema'); 
                        $mail->addAddress($doctor_email); 

                        $mail->isHTML(true);
                        $mail->Subject = "Cancelacion de Cita";
                        $mail->Body    = "Estimado doctor, la cita programada para las $schedule_time ha sido cancelada por el paciente.";

                        if ($mail->send()) {
                            
                            $sql_delete = "DELETE FROM appointment WHERE appoid = ?";
                            $stmt_delete = $database->prepare($sql_delete);
                            if ($stmt_delete) {
                                $stmt_delete->bind_param("i", $idappo);
                                $stmt_delete->execute();

                                header("location: ../controllers/patient/appointment_controller.php");
                                exit();
                            } else {
                                echo "Error al eliminar la cita.";
                            }
                        } else {
                            echo "Error al enviar el email: {$mail->ErrorInfo}";
                        }
                    } catch (Exception $e) {
                        echo "Error al enviar el correo: {$mail->ErrorInfo}";
                    }
                } else {
                    echo "No se encontró el horario correspondiente.";
                }
            } else {
                echo "Error al preparar la consulta SQL para obtener la hora de la cita.";
            }
        } else {
            echo "No se encontró el doctor correspondiente.";
        }
    } else {
        echo "Error al preparar la consulta SQL para obtener el correo del doctor.";
    }
}
?>
