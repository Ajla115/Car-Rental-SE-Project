<?php

require_once __DIR__ . '/../services/CustomerService.php';

use PHPUnit\Framework\TestCase;

class AddAdminTest extends TestCase
{
    protected static $customerService;

    public static function setUpBeforeClass(): void
    {
        self::$customerService = new CustomerService();
    }

    public function testAddAdminWithValidData()
    {
        $adminData = [
            'customer_name' => 'John',
            'customer_surname' => 'Doe',
            'email' => 'john.doe@admin.gmail.com',
            'password' => 'strongPassword'
        ];

        $result = self::$customerService->addAdmin($adminData);

        $this->assertArrayHasKey('customer', $result);
        $this->assertArrayHasKey('id', $result['customer']);
        $this->assertEquals(200, $result['status']);
    }

    public function testAddAdminWithInvalidEmailFormat()
    {
        $adminData = [
            'customer_name' => 'Jane',
            'customer_surname' => 'Doe',
            'email' => 'jane.doe@example.com', 
            'password' => 'password'
        ];

        $result = self::$customerService->addAdmin($adminData);

        $this->assertEquals(400, $result['status']);
        $this->assertStringContainsString('Admin email must be in the form @admin.gmail.com.', $result['message']);
    }

    public function testAddAdminWithShortPassword()
    {
        $adminData = [
            'customer_name' => 'Admin',
            'customer_surname' => 'Tester',
            'email' => 'admin.tester@admin.gmail.com',
            'password' => 'short'
        ];

        $result = self::$customerService->addAdmin($adminData);

        $this->assertEquals(400, $result['status']);
        $this->assertStringContainsString('The password should not be shorter than 8 characters.', $result['message']);
    }

}

?>
