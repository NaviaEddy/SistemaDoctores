<?php

class ScheduleModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getAppointmentsByPatientId($patientId, $today)
    {
        $sql = "SELECT * FROM schedule 
                INNER JOIN appointment ON schedule.scheduleid = appointment.scheduleid 
                INNER JOIN doctor ON schedule.docid = doctor.docid  
                WHERE appointment.pid = ? AND schedule.scheduledate >= ? 
                ORDER BY schedule.scheduledate ASC";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param("is", $patientId, $today);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getTodaySessionsCount($today)
    {
        $sql = "SELECT * FROM schedule WHERE scheduledate = ?";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param("s", $today);
        $stmt->execute();
        return $stmt->get_result()->num_rows;
    }

    public function getFutureAppointments($today) {
        $query = "SELECT * FROM appointment WHERE appodate >= ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param('s', $today); 
        $stmt->execute();
        return $stmt->get_result()->num_rows;
    }
}

?>
