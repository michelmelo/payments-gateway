<?php

use PHPUnit\Framework\TestCase;
use YourNamespace\Exceptions\PaymentException;
use YourNamespace\Services\CardService;

class CardServiceTest extends TestCase
{
    protected $cardService;

    protected function setUp(): void
    {
        $this->cardService = new CardService();
    }

    public function testProcessPaymentSuccess()
    {
        $paymentData = [
            'amount'      => 1000,
            'currency'    => 'EUR',
            'card_number' => '4111111111111111',
            'expiry_date' => '12/25',
            'cvv'         => '123',
        ];

        $result = $this->cardService->processPayment($paymentData);
        $this->assertTrue($result['success']);
        $this->assertNotEmpty($result['transaction_id']);
    }

    public function testProcessPaymentFailure()
    {
        $this->expectException(PaymentException::class);

        $paymentData = [
            'amount'      => 1000,
            'currency'    => 'EUR',
            'card_number' => 'invalid_card_number',
            'expiry_date' => '12/25',
            'cvv'         => '123',
        ];

        $this->cardService->processPayment($paymentData);
    }

    public function testInvalidAmount()
    {
        $this->expectException(PaymentException::class);

        $paymentData = [
            'amount'      => -100,
            'currency'    => 'EUR',
            'card_number' => '4111111111111111',
            'expiry_date' => '12/25',
            'cvv'         => '123',
        ];

        $this->cardService->processPayment($paymentData);
    }
}
