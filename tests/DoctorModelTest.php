<?php

use PHPUnit\Framework\TestCase;

class DoctorModelTest extends TestCase
{
    private $databaseMock;
    private $doctorModel;
    private $statementMock;
    private $mockStmt;

    protected function setUp(): void
    {
        $this->databaseMock = $this->createMock(mysqli::class);
        $this->statementMock = $this->createMock(mysqli_result::class);
        $this->mockStmt = $this->createMock(mysqli_stmt::class);
        $this->doctorModel = new DoctorModel($this->databaseMock);
    }

    public function testGetAllDoctors()
    {
        $this->databaseMock->method('query')
            ->with("SELECT * FROM doctor order by docid desc")
            ->willReturn($this->statementMock);

        $this->assertInstanceOf(mysqli_result::class, $this->doctorModel->getAllDoctors());
    }

    public function testGetDoctorByEmail()
    {
        $email = 'doctor@example.com';

        $this->databaseMock->method('prepare')
            ->with("SELECT * FROM doctor WHERE docemail = ?")
            ->willReturn($this->mockStmt);

        $this->mockStmt->expects($this->once())
            ->method('bind_param')
            ->with('s', $email);

        $this->mockStmt->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->mockStmt->method('get_result')
            ->willReturn($this->statementMock);

        $this->statementMock->method('fetch_assoc')
            ->willReturn(['docid' => 1, 'docname' => 'Dr. John', 'docemail' => $email]);

        $result = $this->doctorModel->getDoctorByEmail($email);
        $this->assertEquals(['docid' => 1, 'docname' => 'Dr. John', 'docemail' => $email], $result);
    }

    public function testValidateCredentialsReturnsDoctor()
    {
        $email = 'doctor@example.com';
        $password = 'password123';
        $expectedResult = ['docemail' => $email, 'docname' => 'Dr. John Smith'];

        $this->databaseMock->expects($this->once())
            ->method('query')
            ->with("SELECT * FROM doctor WHERE docemail='$email' AND docpassword='$password'")
            ->willReturn($this->statementMock);

        $this->statementMock->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn($expectedResult);

        $result = $this->doctorModel->validateCredentials($email, $password);
        $this->assertEquals($expectedResult, $result);
    }
}
