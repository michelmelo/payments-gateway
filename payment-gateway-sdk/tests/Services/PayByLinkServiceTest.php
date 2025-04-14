<?php

use PHPUnit\Framework\TestCase;
use YourNamespace\Services\PayByLinkService;

class PayByLinkServiceTest extends TestCase
{
    protected $payByLinkService;

    protected function setUp(): void
    {
        $this->payByLinkService = new PayByLinkService();
    }

    public function testProcessPayment()
    {
        // Arrange
        $paymentData = [
            'amount'         => 1000,
            'currency'       => 'EUR',
            'description'    => 'Test payment',
            'customer_email' => 'customer@example.com',
        ];

        // Act
        $response = $this->payByLinkService->processPayment($paymentData);

        // Assert
        $this->assertArrayHasKey('payment_link', $response);
        $this->assertEquals('success', $response['status']);
    }

    public function testInvalidPaymentData()
    {
        // Arrange
        $paymentData = [
            'amount'         => 0,
            'currency'       => 'EUR',
            'description'    => '',
            'customer_email' => 'customer@example.com',
        ];

        // Act & Assert
        $this->expectException(YourNamespace\Exceptions\PaymentException::class);
        $this->payByLinkService->processPayment($paymentData);
    }

    // Additional tests can be added here
}
