<?php

class DashboardController
{
    private $patientModel;
    private $doctorModel;
    private $scheduleModel;

    public function __construct($patientModel, $doctorModel, $scheduleModel)
    {
        $this->patientModel = $patientModel;
        $this->doctorModel = $doctorModel;
        $this->scheduleModel = $scheduleModel;

    }

    public function loadDashboard($userEmail)
    {
        $patient = $this->patientModel->getPatientByEmail($userEmail);
        $today = date('Y-m-d');
        
        $data = [
            'useremail' => $userEmail,
            'username' => $patient['pname'],
            'patientCount' => $this->patientModel->getPatientCount(),
            'doctorCount' => $this->doctorModel->getDoctorCount(),
            'todaySessions' => $this->scheduleModel->getTodaySessionsCount($today),
            'appointments' => $this->scheduleModel->getAppointmentsByPatientId($patient['pid'], $today),
            'futureAppointments' => $this->scheduleModel->getFutureAppointments($today)
        ];

        return $data;
    }
}

?>
