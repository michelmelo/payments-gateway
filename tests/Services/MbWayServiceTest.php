<?php

use MichelMelo\PaymentGateway\Services\MbWayService;
use PHPUnit\Framework\TestCase; // Adjust the namespace as necessary

class MbWayServiceTest extends TestCase
{
    protected $mbWayService;

    protected function setUp(): void
    {
        $this->mbWayService = new MbWayService();
    }

    public function testProcessPayment()
    {
        $paymentData = [
            'amount'      => 1000,
            'phone'       => '912345678',
            'description' => 'Test payment',
        ];

        $result = $this->mbWayService->processPayment($paymentData);
        $this->assertArrayHasKey('status', $result);
        $this->assertEquals('success', $result['status']);
    }

    public function testInvalidPaymentData()
    {
        $this->expectException(MichelMelo\PaymentGateway\Exceptions\PaymentException::class);

        $invalidData = [
            'amount' => 1000,
            // Missing phone and description
        ];

        $this->mbWayService->processPayment($invalidData);
    }

    public function testGetPaymentStatus()
    {
        $paymentId = '123456';
        $result    = $this->mbWayService->getPaymentStatus($paymentId);
        $this->assertArrayHasKey('status', $result);
    }
}
