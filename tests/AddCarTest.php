<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../rest/services/CarinfoService.php';
require_once __DIR__ . '/../rest/dao/CarinfoDao.class.php';

class CarinfoServiceTest extends TestCase {

    protected static \PDO $pdo;

    public static function setUpBeforeClass(): void {
        self::$pdo = new \PDO('mysql:host=localhost;dbname=test_database', 'username', 'password');
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        self::$pdo->exec('CREATE TABLE IF NOT EXISTS carinfo (
            id INT AUTO_INCREMENT PRIMARY KEY,
            car_name VARCHAR(255) NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            age INT NOT NULL,
            mileage VARCHAR(255) NOT NULL,
            fuel VARCHAR(255) NOT NULL,
            fuel_usage VARCHAR(255) NOT NULL,
            gearbox VARCHAR(255) NOT NULL,
            max_passengers INT NOT NULL,
            car_type VARCHAR(255) NOT NULL
        )');
    }

    public function testAddCar() {
        $carData = [
            'car_name' => 'Test Car',
            'price' => 25000.00,
            'age' => 2,
            'mileage' => '20,000 miles',
            'fuel' => 'Gasoline',
            'fuel_usage' => '10 km/l',
            'gearbox' => 'Automatic',
            'max_passengers' => 5,
            'car_type' => 'sedan',
        ];

        $carinfoDao = new CarinfoDao(self::$pdo);
        $carinfoService = new CarinfoService($carinfoDao);

        $result = $carinfoService->add($carData);

        $this->assertTrue($result);

        $addedCar = $carinfoService->get_by_type('sedan');
        $this->assertEquals($carData['car_name'], $addedCar['car_name']);
        $this->assertEquals($carData['price'], $addedCar['price']);
    }

    public static function tearDownAfterClass(): void {
        self::$pdo->exec('DROP TABLE carinfo');
    }
}

?>
