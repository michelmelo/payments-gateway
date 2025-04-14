<?php

use PHPUnit\Framework\TestCase;
use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Services\MultibancoService;

class MultibancoServiceTest extends TestCase
{
    protected $multibancoService;

    protected function setUp(): void
    {
        $this->multibancoService = new MultibancoService();
    }

    public function testProcessPaymentSuccess()
    {
        $paymentData = [
            'amount'      => 1000,
            'reference'   => '123456789',
            'description' => 'Test payment',
        ];

        $result = $this->multibancoService->processPayment($paymentData);
        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('payment_url', $result);
    }

    public function testProcessPaymentFailure()
    {
        $this->expectException(PaymentException::class);

        $paymentData = [
            'amount'      => 0, // Invalid amount
            'reference'   => '123456789',
            'description' => 'Test payment',
        ];

        $this->multibancoService->processPayment($paymentData);
    }

    public function testGetPaymentStatus()
    {
        $paymentId = 'test_payment_id';
        $result    = $this->multibancoService->getPaymentStatus($paymentId);
        $this->assertArrayHasKey('status', $result);
    }
}
