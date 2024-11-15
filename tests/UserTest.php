<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        $host = getenv('MYSQL_HOST') ?: 'localhost';
        $db = getenv('MYSQL_DATABASE') ?: 'user_auth';
        $user = getenv('MYSQL_USER') ?: 'root';
        $pass = getenv('MYSQL_PASSWORD') ?: 'root';
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {
            $this->pdo = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            $this->fail("Database connection failed: " . $e->getMessage());
        }
    }

    public function testUserInsertion(): void
    {
        $query = $this->pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
        $result = $query->execute([':name' => 'John Doe', ':email' => 'john.doe@example.com']);
        $this->assertTrue($result, "User insertion failed");
    }
}
