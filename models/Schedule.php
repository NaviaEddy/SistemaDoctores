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

    public function getScheduleSessionsToday($today){
        $query = "SELECT * 
              FROM schedule 
              INNER JOIN doctor ON schedule.docid = doctor.docid 
              WHERE schedule.scheduledate >= ? 
              ORDER BY schedule.scheduledate ASC";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param('s', $today);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getScheduleSessionsId($id){
        $query = "SELECT * 
              FROM schedule 
              INNER JOIN doctor ON schedule.docid = doctor.docid 
              WHERE schedule.scheduleid = ? 
              ORDER BY schedule.scheduledate DESC";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUpcomingSessions($today, $nextweek) {
        $stmt = $this->database->prepare(
            "SELECT schedule.scheduleid, schedule.title, doctor.docname, schedule.scheduledate, 
                    schedule.scheduletime, schedule.nop 
             FROM schedule 
             INNER JOIN doctor ON schedule.docid = doctor.docid 
             WHERE schedule.scheduledate >= ? AND schedule.scheduledate <= ?
             ORDER BY schedule.scheduledate DESC"
        );
        $stmt->bind_param("ss", $today, $nextweek);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getAppointmentsDoctorCount($doctorId) {
        $sql = "SELECT * FROM schedule 
                INNER JOIN appointment ON schedule.scheduleid=appointment.scheduleid 
                WHERE schedule.docid=?";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param('s', $doctorId);
        $stmt->execute();
        return $stmt->get_result()->num_rows;
    }

    public function getSchedulesSessionsDoctorCount($doctorId) {
        $sql = "SELECT  * FROM schedule where docid=?;";
        $stmt = $this->database->prepare($sql);
        $stmt->bind_param('s', $doctorId);
        $stmt->execute();
        return $stmt->get_result()->num_rows;
    }

    public function getSchedulesSessionsDoctor($docid){
        $query = "SELECT * 
              FROM schedule 
              INNER JOIN doctor ON schedule.docid = doctor.docid 
              WHERE schedule.docid= ?";
        $stmt = $this->database->prepare($query);
        $stmt->bind_param('s', $docid);
        $stmt->execute();
        return $stmt->get_result();
    }
}

?>
