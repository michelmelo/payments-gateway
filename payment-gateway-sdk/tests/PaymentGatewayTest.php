<?php

use PHPUnit\Framework\TestCase;
use YourNamespace\PaymentGateway; // Adjust the namespace as necessary

class PaymentGatewayTest extends TestCase
{
    protected $paymentGateway;

    protected function setUp(): void
    {
        $this->paymentGateway = new PaymentGateway();
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
        $result = $this->paymentGateway->processPayment('mbway', $amount, $data);
        $this->assertTrue($result['success']);
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
}
