<?php

use PHPUnit\Framework\TestCase;
use YourNamespace\Services\BlikService; // Adjust the namespace as necessary

class BlikServiceTest extends TestCase
{
    protected $blikService;

    protected function setUp(): void
    {
        $this->blikService = new BlikService();
    }

    public function testProcessPayment()
    {
        // Mock payment data
        $paymentData = [
            'amount'   => 1000,
            'currency' => 'PLN',
            'blikCode' => '123456',
        ];

        $response = $this->blikService->processPayment($paymentData);

        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('success', $response['status']);
    }

    public function testInvalidBlikCode()
    {
        // Mock payment data with invalid BLIK code
        $paymentData = [
            'amount'   => 1000,
            'currency' => 'PLN',
            'blikCode' => 'invalid',
        ];

        $this->expectException(YourNamespace\Exceptions\PaymentException::class);
        $this->blikService->processPayment($paymentData);
    }

    // Additional tests can be added here
}
