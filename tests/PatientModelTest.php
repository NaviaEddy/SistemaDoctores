<?php

use PHPUnit\Framework\TestCase;

class PatientModelTest extends TestCase
{
    private $patientModel;
    private $databaseMock;
    private $statementMock;
    private $resultMock;

    protected function setUp(): void
    {
        $this->databaseMock = $this->createMock(mysqli::class);
        $this->statementMock = $this->createMock(mysqli_stmt::class);
        $this->resultMock = $this->createMock(mysqli_result::class);
        $this->patientModel = new PatientModel($this->databaseMock);
    }

    public function testCreatePatientReturnsTrueOnSuccess()
    {
        $email = 'test@example.com';
        $name = 'John Doe';
        $password = 'password123';
        $address = '123 Street';
        $dob = '1990-01-01';
        $tele = '123456789';

        $this->statementMock->expects($this->once())
            ->method('bind_param')
            ->with("ssssss", $email, $name, $password, $address, $dob, $tele)
            ->willReturn(true);
        $this->statementMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->databaseMock->expects($this->once())
            ->method('prepare')
            ->with("INSERT INTO patient(pemail, pname, ppassword, paddress, pdob, ptel, isActive, lastConnection) VALUES (?, ?, ?, ?, ?, ?, '1', NOW())")
            ->willReturn($this->statementMock);

        $result = $this->patientModel->createPatient($email, $name, $password, $address, $dob, $tele);
        $this->assertTrue($result);
    }

    public function testGetPatientByEmailReturnsPatient()
    {
        $email = 'test@example.com';
        $expectedResult = ['pemail' => $email, 'pname' => 'John Doe'];

        $this->statementMock->expects($this->once())
            ->method('bind_param')
            ->with("s", $email)
            ->willReturn(true);
        $this->statementMock->expects($this->once())
            ->method('execute')
            ->willReturn(true);
        $this->statementMock->expects($this->once())
            ->method('get_result')
            ->willReturn($this->resultMock);

        $this->resultMock->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn($expectedResult);

        $this->databaseMock->expects($this->once())
            ->method('prepare')
            ->with("SELECT * FROM patient WHERE pemail = ?")
            ->willReturn($this->statementMock);


        $result = $this->patientModel->getPatientByEmail($email);
        $this->assertEquals($expectedResult, $result);
    }

    public function testValidateCredentialsReturnsPatient()
    {
        $email = 'test@example.com';
        $password = 'password123';
        $expectedResult = ['pemail' => $email, 'pname' => 'John Doe'];

        $this->resultMock->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn($expectedResult);

        $this->databaseMock->expects($this->once())
            ->method('query')
            ->with("SELECT * FROM patient WHERE pemail='$email' AND ppassword='$password'")
            ->willReturn($this->resultMock);

        $result = $this->patientModel->validateCredentials($email, $password);
        $this->assertEquals($expectedResult, $result);
    }

    public function testUpdateLastConnectionReturnsTrue()
    {
        $email = 'test@example.com';

        $this->databaseMock->expects($this->once())
            ->method('query')
            ->with("UPDATE patient SET lastConnection = NOW() WHERE pemail = '$email'")
            ->willReturn(true);

        $result = $this->patientModel->updateLastConnection($email);
        $this->assertTrue($result);
    }
}
