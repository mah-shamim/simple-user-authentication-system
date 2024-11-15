<?php
use PHPUnit\Framework\TestCase;
use PDO;

class UserTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        // Connect to the MySQL database
        $this->pdo = new PDO('mysql:host=mysql;dbname=user_auth', 'root', 'root');
    }

    public function testUserInsertion()
    {
        // Query the database to check if the users were inserted
        $stmt = $this->pdo->query("SELECT * FROM users WHERE username = 'user1'");
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assert that the user exists and data is correct
        $this->assertNotEmpty($user);
        $this->assertEquals('user1', $user['username']);
        $this->assertEquals('user1@example.com', $user['email']);
    }

    // Add more tests as necessary
}
