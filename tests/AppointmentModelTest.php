<?php
require_once __DIR__ . '/../models/Appointment.php';
use PHPUnit\Framework\TestCase;

class AppointmentModelTest extends TestCase
{
    private $database;
    private $appointmentModel;

    protected function setUp(): void
    {

        $this->database = $this->createMock(stdClass::class);
        $this->appointmentModel = new AppointmentModel($this->database);
    }

    public function testGetFutureAppointments()
    {

        $resultMock = $this->createMock(stdClass::class);
        $resultMock->num_rows = 5;

        $stmtMock = $this->createMock(stdClass::class);
        $stmtMock->method('get_result')->willReturn($resultMock);

        $this->database->method('prepare')->willReturn($stmtMock);

        $today = '2024-10-16';

        $numAppointments = $this->appointmentModel->getFutureAppointments($today);
        $this->assertEquals(5, $numAppointments);
    }

    public function testGetNumberAppointment()
    {

        $resultMock = $this->createMock(stdClass::class);
        $resultMock->num_rows = 3;

        $stmtMock = $this->createMock(stdClass::class);
        $stmtMock->method('get_result')->willReturn($resultMock);

        $this->database->method('prepare')->willReturn($stmtMock);

        $scheduleId = '5';

        $numAppointments = $this->appointmentModel->getNumberAppointment($scheduleId);
        $this->assertEquals(3, $numAppointments);
    }
}
?>
