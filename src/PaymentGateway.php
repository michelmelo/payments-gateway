<?php

namespace MichelMelo\PaymentGateway;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Helpers\Logger; // Adicionado
use MichelMelo\PaymentGateway\Services\BlikService;
use MichelMelo\PaymentGateway\Services\CardService;
use MichelMelo\PaymentGateway\Services\MbWayService;
use MichelMelo\PaymentGateway\Services\MultibancoService;
use MichelMelo\PaymentGateway\Services\PayByLinkService;
use MichelMelo\PaymentGateway\Services\XPayService;

class PaymentGateway
{
    public $services = [];
    private $bearerToken;
    private $clientId;
    private $terminalId;
    private $paymentType;
    private $url;

    public function __construct($bearerToken, $clientId, $terminalId, $paymentType, $url)
    {
        Logger::log("Initializing PaymentGateway with clientId: {$clientId}"); // Log

        $this->bearerToken = $bearerToken;
        $this->clientId    = $clientId;
        $this->terminalId  = $terminalId;
        $this->paymentType = $paymentType;
        $this->url         = $url;

        //$this->services['mbway']      = new MbWayService($this->url);
        //$this->services['multibanco'] = new MultibancoService($this->url);
        $this->services['card']       = new CardService($this->url);
        $this->services['xpay']       = new XPayService($this->url);
        $this->services['blik']       = new BlikService($this->url);
        $this->services['paybylink']  = new PayByLinkService($this->url);
    }

    public function processPayment($method, $data, $customer)
    {
        Logger::log("Processing payment with method: {$method}"); // Log

        if (! isset($this->services[$method])) {
            Logger::log("Payment method not supported: {$method}"); // Log

            throw new PaymentException('Payment method not supported.');
        }

        $service = $this->services[$method];

        // Valida os dados de pagamento
        if (! isset($data)) {
            $service->validatePayment($data);
            // Add the required data to the payment request
            $data['bearerToken'] = $this->bearerToken;
            $data['clientId']    = $this->clientId;
            $data['terminalId']  = $this->terminalId;
            $data['paymentType'] = $this->paymentType;
            $data['url']         = $this->url;
        }
        $data['customer']    = $customer;

        // Processa o pagamento
        return $service->processPayment($data);
    }
    public function refundPayment($method, $transactionId, $amountValue, $amountCurrency, $customerInfo = [])
    {
        Logger::log("Refund payment with method: {$method}"); // Log

        if (!isset($this->services[$method])) {
            Logger::log("Refund method not supported: {$method}"); // Log
            throw new PaymentException('Refund method not supported.');
        }

        $service = $this->services[$method];

        // Adiciona os parâmetros necessários ao array de informações do cliente
        $customerInfo['bearerToken'] = $this->bearerToken;
        $customerInfo['clientId']    = $this->clientId;
        $customerInfo['terminalId']  = $this->terminalId;
        $customerInfo['paymentType'] = $this->paymentType;
        $customerInfo['url']         = $this->url;

        // Chama o método refundPayment do serviço correspondente
        return $service->refundPayment($transactionId, $amountValue, $amountCurrency, $customerInfo);
    }

    public function config($paymentMethod, $language, $currencies, $redirectUrl)
    {
        $config = [
            'paymentMethodList'         => [$paymentMethod],
            'paymentMethodsforCheckout' => [$paymentMethod],
            'language'                  => $language,
            'currencies'                => $currencies,
            'redirectUrl'               => $redirectUrl,

        ];

        return json_encode($config);
    }
}
