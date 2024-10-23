<?php
use PHPUnit\Framework\TestCase;

class AdminModelTest extends TestCase
{
    private $databaseMock;
    private $adminModel;
    private $statementMock;

    protected function setUp(): void
    {
        $this->databaseMock = $this->createMock(mysqli::class);
        $this->statementMock = $this->createMock(mysqli_result::class);
        $this->adminModel = new AdminModel($this->databaseMock);
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
