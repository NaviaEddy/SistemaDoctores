<?php

use PHPUnit\Framework\TestCase;

class ScheduleModelTest extends TestCase
{
    private $scheduleModel;
    private $databaseMock;
    private $statementMock;
    private $resultMock;

    protected function setUp(): void
    {
        $this->databaseMock = $this->createMock(mysqli::class);
        $this->statementMock = $this->createMock(mysqli_stmt::class);
        $this->resultMock = $this->createMock(mysqli_result::class);
        $this->scheduleModel = new ScheduleModel($this->databaseMock);
    }

    public function testGetUpcomingSessions()
    {
        $today = '2024-11-06';
        $nextWeek = '2024-11-13';

        $this->databaseMock->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains("SELECT schedule.scheduleid, schedule.title, doctor.docname"))
            ->willReturn($this->statementMock);

        $this->statementMock->expects($this->once())
            ->method('bind_param')
            ->with('ss', $today, $nextWeek);

        $this->statementMock->expects($this->once())
            ->method('execute');

        $this->statementMock->expects($this->once())
            ->method('get_result')
            ->willReturn($this->resultMock);

        $result = $this->scheduleModel->getUpcomingSessions($today, $nextWeek);
        $this->assertInstanceOf(mysqli_result::class, $result);
    }

}
