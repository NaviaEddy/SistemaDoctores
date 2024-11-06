<?php
use PHPUnit\Framework\TestCase;

class AdminModelTest extends TestCase
{
    private $databaseMock;
    private $adminModel;
    private $statementMock;
    private $mockStmt;

    protected function setUp(): void
    {
        $this->databaseMock = $this->createMock(mysqli::class);
        $this->statementMock = $this->createMock(mysqli_result::class);
        $this->mockStmt = $this->createMock(mysqli_stmt::class);
        $this->adminModel = new AdminModel($this->databaseMock);
    }

    public function testGetAdminByEmailReturnsCorrectData()
    {
        $email = 'admin@example.com';
        $expectedData = ['aemail' => 'admin@example.com', 'aname' => 'Admin Test'];

        $this->databaseMock->method('prepare')->willReturn($this->mockStmt);

        $this->mockStmt
            ->expects($this->once())
            ->method('bind_param')
            ->with('s', $email);

        $this->mockStmt
            ->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->mockStmt
            ->method('get_result')
            ->willReturn($this->statementMock);

        $this->statementMock
            ->method('fetch_assoc')
            ->willReturn($expectedData);

        $result = $this->adminModel->getAdminByEmail($email);

        $this->assertSame($expectedData, $result);
    }

    public function testGetAdminByEmailReturnsNullWhenNoData()
    {
        $email = 'nonexistent@example.com';

        $this->databaseMock->method('prepare')->willReturn($this->mockStmt);

        $this->mockStmt
            ->expects($this->once())
            ->method('bind_param')
            ->with('s', $email);

        $this->mockStmt
            ->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $this->mockStmt
            ->method('get_result')
            ->willReturn($this->statementMock);

        $this->statementMock
            ->method('fetch_assoc')
            ->willReturn(null);

        $result = $this->adminModel->getAdminByEmail($email);

        $this->assertNull($result);
    }

    public function testValidateCredentialsReturnsCorrectData()
    {
        $expectedData = ['aemail' => 'admin@example.com', 'apassword' => 'password123'];

        $this->statementMock->method('fetch_assoc')
            ->willReturn($expectedData);

        $this->databaseMock->method('query')
            ->with("SELECT * FROM admin WHERE aemail='admin@example.com' AND apassword='password123'")
            ->willReturn($this->statementMock);

        $result = $this->adminModel->validateCredentials('admin@example.com', 'password123');
        $this->assertSame($expectedData, $result);
    }

    public function testValidateCredentialsFailure()
    {

        $email = "wrong@test.com";
        $password = "wrongpass";

        $this->databaseMock
            ->expects($this->once())
            ->method('query')
            ->with("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'")
            ->willReturn($this->statementMock);

        $this->statementMock
            ->expects($this->once())
            ->method('fetch_assoc')
            ->willReturn(null);

        $result = $this->adminModel->validateCredentials($email, $password);
        $this->assertNull($result);
    }
}
?>
