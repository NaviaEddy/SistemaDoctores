<?php

use PHPUnit\Framework\TestCase;

class WebuserModelTest extends TestCase {
    private $webuserModel;
    private $databaseMock;
    private $statementMock;
    private $resultMock;

    protected function setUp(): void {
        $this->databaseMock = $this->createMock(mysqli::class);
        $this->statementMock = $this->createMock(mysqli_stmt::class);
        $this->resultMock = $this->createMock(mysqli_result::class);
        $this->webuserModel = new WebuserModel($this->databaseMock);
    }

    public function testGetWebUserByEmailReturnsUser() {
        $email = 'test@example.com';
        $expectedResult = ['email' => $email, 'status' => 'p'];

        $this->statementMock->expects($this->once())
                            ->method('bind_param')
                            ->with($this->equalTo("s"), $this->equalTo($email))
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
                           ->with($this->equalTo("SELECT * FROM webuser WHERE email=?"))
                           ->willReturn($this->statementMock);

        $result = $this->webuserModel->getWebUserByEmail($email);
        $this->assertEquals($expectedResult, $result);
    }

    public function testCreateWebUserReturnsTrueOnSuccess() {
        $email = 'newuser@example.com';

        $this->statementMock->expects($this->once())
                            ->method('bind_param')
                            ->with($this->equalTo("s"), $this->equalTo($email))
                            ->willReturn(true);
        $this->statementMock->expects($this->once())
                            ->method('execute')
                            ->willReturn(true);

        $this->databaseMock->expects($this->once())
                           ->method('prepare')
                           ->with($this->equalTo("INSERT INTO webuser VALUES (?, 'p')"))
                           ->willReturn($this->statementMock);
        $result = $this->webuserModel->createWebUser($email);
        $this->assertTrue($result);
    }

    public function testCreateWebUserReturnsFalseOnFailure() {
        $email = 'faileduser@example.com';

        $this->statementMock->expects($this->once())
                            ->method('bind_param')
                            ->with($this->equalTo("s"), $this->equalTo($email))
                            ->willReturn(true);
        $this->statementMock->expects($this->once())
                            ->method('execute')
                            ->willReturn(false);

        $this->databaseMock->expects($this->once())
                           ->method('prepare')
                           ->with($this->equalTo("INSERT INTO webuser VALUES (?, 'p')"))
                           ->willReturn($this->statementMock);

        $result = $this->webuserModel->createWebUser($email);
        $this->assertFalse($result);
    }
}
