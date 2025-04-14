<?php

use PHPUnit\Framework\TestCase;
use MichelMelo\PaymentGateway\Services\XPayService; // Adjust the namespace according to your project structure

class XPayServiceTest extends TestCase
{
    protected $xPayService;

    protected function setUp(): void
    {
        $this->xPayService = new XPayService();
    }

    public function testProcessPayment()
    {
        // Arrange
        $paymentData = [
            'amount'      => 100,
            'currency'    => 'EUR',
            'description' => 'Test payment',
            'customer'    => [
                'email' => 'customer@example.com',
                'name'  => 'John Doe',
            ],
        ];

        // Act
        $response = $this->xPayService->processPayment($paymentData);

        // Assert
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('success', $response['status']);
    }

    public function testProcessPaymentWithInvalidData()
    {
        // Arrange
        $invalidPaymentData = [
            'amount'      => 0,
            'currency'    => 'EUR',
            'description' => 'Test payment',
            'customer'    => [
                'email' => 'customer@example.com',
                'name'  => 'John Doe',
            ],
        ];

        // Act & Assert
        $this->expectException(MichelMelo\PaymentGateway\Exceptions\PaymentException::class);
        $this->xPayService->processPayment($invalidPaymentData);
    }

    // Additional tests can be added here
}
