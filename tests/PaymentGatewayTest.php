<?php

namespace MichelMelo\PaymentGateway\Tests;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\PaymentGateway;
use PHPUnit\Framework\TestCase;

class PaymentGatewayTest extends TestCase
{
    private $paymentGateway;

    protected function setUp(): void
    {
        $this->paymentGateway = new PaymentGateway(
            'test-bearer-token',
            'test-client-id',
            'test-terminal-id',
            'PURS',
            'https://api.paymentgateway.com'
        );
    }

    public function testInitializeServices()
    {
        $this->assertNotNull($this->paymentGateway->getMbWayService());
        $this->assertNotNull($this->paymentGateway->getMultibancoService());
        $this->assertNotNull($this->paymentGateway->getCardService());
        $this->assertNotNull($this->paymentGateway->getXPayService());
        $this->assertNotNull($this->paymentGateway->getBlikService());
        $this->assertNotNull($this->paymentGateway->getPayByLinkService());
    }

    public function testProcessPaymentWithMbWay()
    {
        $customer = [
            'customerInfo' => [
                'customerName'    => 'John Smith',
                'customerEmail'   => 'john@email.com',
                'customerPhone'   => '+351-912345678',
                'shippingAddress' => [
                    'street1'  => 'Shipping street1',
                    'street2'  => 'Shipping street2',
                    'city'     => 'Lisbon',
                    'postcode' => '1700-123',
                    'country'  => 'PT',
                ],
                'billingAddress' => [
                    'street1'  => 'Billing street1',
                    'street2'  => 'Billing street2',
                    'city'     => 'Lisbon',
                    'postcode' => '1700-123',
                    'country'  => 'PT',
                ],
            ],
        ];

        $data = [
            'amount'   => 10.00,
            'currency' => 'EUR',
        ];

        $response = $this->paymentGateway->processPayment('mbway', $data, $customer);

        $this->assertNotNull($response);
        $this->assertIsArray($response);
    }

    public function testProcessPaymentWithMultibanco()
    {
        $result = $this->paymentGateway->processPayment('multibanco', $amount, $data);
        $this->assertTrue($result['success']);
    }

    public function testProcessPaymentWithCard()
    {
        $result = $this->paymentGateway->processPayment('card', $amount, $data);
        $this->assertTrue($result['success']);
    }

    public function testProcessPaymentWithXPay()
    {
        $result = $this->paymentGateway->processPayment('xpay', $amount, $data);
        $this->assertTrue($result['success']);
    }

    public function testProcessPaymentWithBlik()
    {
        $result = $this->paymentGateway->processPayment('blik', $amount, $data);
        $this->assertTrue($result['success']);
    }

    public function testProcessPaymentWithPayByLink()
    {
        $result = $this->paymentGateway->processPayment('paybylink', $amount, $data);
        $this->assertTrue($result['success']);
    }

    public function testProcessPaymentWithInvalidMethod()
    {
        $this->expectException(PaymentException::class);
        $this->expectExceptionMessage('Payment method not supported.');

        $customer = [
            'customerInfo' => [
                'customerName'    => 'John Smith',
                'customerEmail'   => 'john@email.com',
                'customerPhone'   => '+351-912345678',
                'shippingAddress' => [
                    'street1'  => 'Shipping street1',
                    'street2'  => 'Shipping street2',
                    'city'     => 'Lisbon',
                    'postcode' => '1700-123',
                    'country'  => 'PT',
                ],
                'billingAddress' => [
                    'street1'  => 'Billing street1',
                    'street2'  => 'Billing street2',
                    'city'     => 'Lisbon',
                    'postcode' => '1700-123',
                    'country'  => 'PT',
                ],
            ],
        ];

        $data = [
            'amount'   => 10.00,
            'currency' => 'EUR',
        ];

        $this->paymentGateway->processPayment('invalid_method', $data, $customer);
    }
}
