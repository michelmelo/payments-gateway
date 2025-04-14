<?php

namespace MichelMelo\PaymentGateway;

use MichelMelo\PaymentGateway\Services\BlikService;
use MichelMelo\PaymentGateway\Services\CardService;
use MichelMelo\PaymentGateway\Services\MbWayService;
use MichelMelo\PaymentGateway\Services\MultibancoService;
use MichelMelo\PaymentGateway\Services\PayByLinkService;
use MichelMelo\PaymentGateway\Services\XPayService;
use MichelMelo\PaymentGateway\Exceptions\PaymentException;

class PaymentGateway
{
    private $services = [];
    private $bearerToken;
    private $clientId;
    private $terminalId;
    private $paymentType;
    private $url;

    public function __construct($bearerToken, $clientId, $terminalId, $paymentType, $url)
    {
        $this->bearerToken = $bearerToken;
        $this->clientId = $clientId;
        $this->terminalId = $terminalId;
        $this->paymentType = $paymentType;
        $this->url = $url;

        $this->services['mbway']      = new MbWayService();
        $this->services['multibanco'] = new MultibancoService();
        $this->services['card']       = new CardService();
        $this->services['xpay']       = new XPayService();
        $this->services['blik']       = new BlikService();
        $this->services['paybylink']  = new PayByLinkService();
    }

    public function processPayment($method, $data, $customer)
    {
        if (!isset($this->services[$method])) {
            throw new PaymentException('Payment method not supported.');
        }

        // Add the required data to the payment request
        $data['bearerToken'] = $this->bearerToken;
        $data['clientId'] = $this->clientId;
        $data['terminalId'] = $this->terminalId;
        $data['paymentType'] = $this->paymentType;
        $data['url'] = $this->url;
        $data['customer'] = $customer;

        return $this->services[$method]->process($data);
    }
}
