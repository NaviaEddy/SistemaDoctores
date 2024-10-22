<?php

require_once './libs/twilio-php/src/Twilio/autoload.php';
use Twilio\Rest\Client;

$sid = 'ACb1c0b07a096f763a312aa5b813baaa0f'; 
$token = '398372e1d392767fe7544dce6c7e5e18'; 
$twilio_number = '+19104151910'; 

$client = new Client($sid, $token);

include("./connection.php");


$sql = "SELECT a.appoid, a.pid, s.scheduleid, s.scheduletime, s.title, s.scheduledate,
               p.pname AS patient_name, p.ptel, d.docname 
        FROM appointment a
        JOIN patient p ON a.pid = p.pid
        INNER JOIN schedule s ON a.scheduleid = s.scheduleid
        INNER JOIN doctor d ON s.docid = d.docid
        WHERE s.scheduledate = CURDATE() 
        AND s.scheduletime > NOW() 
        AND s.scheduletime < DATE_ADD(NOW(), INTERVAL 1 HOUR)";


$result = $database->query($sql);
if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $whatsapp_number = str_replace(' ', '', $row['ptel']);
        $appointment_date = date("d/m/Y", strtotime($row['scheduledate'])); 
        $appointment_time = date("H:i", strtotime($row['scheduletime']));
        $title = $row['title'];
        $patient_name = $row['patient_name'];
        $doctor_name = $row['docname'];
        $message = "Hola $patient_name, recordatorio: Tienes una $title con Dr(a). $doctor_name programada para el $appointment_date a hrs $appointment_time. ¡No olvides asistir!";
        //echo "Mensaje enviado a: $message\n";
        try {
            $client->messages->create($whatsapp_number, [
                'from' => $twilio_number,
                'body' => $message,
            ]);
            echo "Recordatorio enviado a: $whatsapp_number\n";
        } catch (Exception $e) {
            echo "Error al enviar recordatorio a $whatsapp_number: " . $e->getMessage() . "\n";
        }
    }
} else {
    echo "No hay citas próximas para enviar recordatorios.\n";
}
?>
