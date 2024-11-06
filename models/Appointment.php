<?php

class AppointmentModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUpcommingAppointemts($today, $nextweek) {
        $sql = "SELECT appointment.appoid, schedule.scheduleid, schedule.title, doctor.docname, patient.pname, 
                schedule.scheduledate, schedule.scheduletime, appointment.apponum, appointment.appodate 
                FROM schedule 
                INNER JOIN appointment ON schedule.scheduleid=appointment.scheduleid 
                INNER JOIN patient ON patient.pid=appointment.pid 
                INNER JOIN doctor ON schedule.docid=doctor.docid  
                WHERE schedule.scheduledate >= ? AND schedule.scheduledate <= ?";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param('ss', $today, $nextweek);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getFutureAppointments($today) {
        $query = "SELECT * FROM appointment WHERE appodate >= ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param('s', $today); 
        $stmt->execute();
        return $stmt->get_result()->num_rows;
    }

    public function getNumberAppointment($id){
        $query = "SELECT * FROM appointment WHERE scheduleid = ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        return $stmt->get_result()->num_rows;
    }

    public function getAppointmentsDoctor($doctorId, $scheduledate) {
        $sql = "SELECT appointment.appoid, schedule.scheduleid, schedule.title, doctor.docname, patient.pname, 
                schedule.scheduledate, schedule.scheduletime, appointment.apponum, appointment.appodate 
                FROM schedule 
                INNER JOIN appointment ON schedule.scheduleid=appointment.scheduleid 
                INNER JOIN patient ON patient.pid=appointment.pid 
                INNER JOIN doctor ON schedule.docid=doctor.docid  
                WHERE doctor.docid=? AND schedule.scheduledate=?";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param('ss', $doctorId, $scheduledate);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getPatientsByDoctor($doctorId) {
        $sql = "SELECT * FROM appointment inner join patient on patient.pid=appointment.pid 
        inner join schedule on schedule.scheduleid=appointment.scheduleid 
        where schedule.docid=?";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param('s', $doctorId);
        $stmt->execute();
        return $stmt->get_result();
    }

}

?>
