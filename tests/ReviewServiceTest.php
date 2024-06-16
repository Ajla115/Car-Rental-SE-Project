<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../rest/services/ReviewService.php'; 

class ReviewServiceTest extends TestCase
{
    protected static \PDO $pdo; 

    public static function setUpBeforeClass(): void
    {
        self::$pdo = new \PDO('mysql:host=localhost;dbname=test_database', 'username', 'password');
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        self::$pdo->exec('CREATE TABLE IF NOT EXISTS reviews (
            id INT AUTO_INCREMENT PRIMARY KEY,
            booking_id INT NOT NULL,
            review_score FLOAT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )');
    }

    public function testAddReview()
    {
        $bookingId = 1;
        $reviewScore = 5.0;

        $reviewService = new ReviewService(self::$pdo);

        $expectedReview = [
            'booking_id' => $bookingId,
            'review_score' => $reviewScore,
        ];

        $reviewService->add($expectedReview);

        $addedReview = $reviewService->get_by_id($bookingId);

        $this->assertEquals($expectedReview['booking_id'], $addedReview['booking_id']);
        $this->assertEquals($expectedReview['review_score'], $addedReview['review_score']);
    }

    public static function tearDownAfterClass(): void
    {
        self::$pdo->exec('DROP TABLE reviews');
    }
}

?>
