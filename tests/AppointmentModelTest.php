<?php
use PHPUnit\Framework\TestCase;

class AppointmentModelTest extends TestCase
{
    private $databaseMock;
    private $appointmentModel;
    private $statementMock;
    private $mockStmt;

    protected function setUp(): void
    {
        $this->databaseMock = $this->createMock(mysqli::class);
        $this->statementMock = $this->createMock(mysqli_result::class);
        $this->mockStmt = $this->createMock(mysqli_stmt::class);
        $this->appointmentModel = new AppointmentModel($this->databaseMock);
    }

    public function testGetUpcomingAppointments()
    {
        $today = '2024-11-01';
        $nextweek = '2024-11-08';

        $this->databaseMock->method('prepare')->willReturn($this->mockStmt);

        $this->mockStmt->expects($this->once())
            ->method('bind_param')
            ->with('ss', $today, $nextweek);

        $this->mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->mockStmt->method('get_result')
            ->willReturn($this->statementMock);

        $this->statementMock->method('fetch_assoc')
            ->willReturn([
                'appoid' => 1,
                'title' => 'Consultation',
                'docname' => 'Dr. Smith',
                'pname' => 'John Doe',
                'scheduledate' => '2024-11-05',
                'scheduletime' => '10:00',
                'apponum' => 3,
                'appodate' => '2024-11-05'
            ]);

        $result = $this->appointmentModel->getUpcommingAppointemts($today, $nextweek);
        $this->assertInstanceOf(mysqli_result::class, $result);
    }

    public function testGetAppointmentsDoctor()
    {
        $doctorId = '456';
        $scheduledate = '2024-11-05';

        $this->databaseMock->method('prepare')->willReturn($this->mockStmt);

        $this->mockStmt->expects($this->once())
            ->method('bind_param')
            ->with('ss', $doctorId, $scheduledate);

        $this->mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->mockStmt->method('get_result')
            ->willReturn($this->statementMock);

        $this->statementMock->method('fetch_assoc')
            ->willReturn([
                'appoid' => 1,
                'title' => 'Consultation',
                'docname' => 'Dr. Smith',
                'pname' => 'John Doe',
                'scheduledate' => '2024-11-05',
                'scheduletime' => '10:00',
                'apponum' => 3,
                'appodate' => '2024-11-05'
            ]);

        $result = $this->appointmentModel->getAppointmentsDoctor($doctorId, $scheduledate);
        $this->assertInstanceOf(mysqli_result::class, $result);
    }

    public function testGetPatientsByDoctor()
    {
        $doctorId = '789';

        $this->databaseMock->method('prepare')->willReturn($this->mockStmt);

        $this->mockStmt->expects($this->once())
            ->method('bind_param')
            ->with('s', $doctorId);

        $this->mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->mockStmt->method('get_result')
            ->willReturn($this->statementMock);

        $this->statementMock->method('fetch_assoc')
            ->willReturn([
                'pid' => 2,
                'pname' => 'Jane Doe',
                'appoid' => 5,
                'scheduleid' => 10
            ]);

        $result = $this->appointmentModel->getPatientsByDoctor($doctorId);
        $this->assertInstanceOf(mysqli_result::class, $result);
    }
}
?>
