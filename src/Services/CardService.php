<?php

namespace MichelMelo\PaymentGateway\Services;

use MichelMelo\PaymentGateway\Exceptions\PaymentException;
use MichelMelo\PaymentGateway\Helpers\Debug;
use MichelMelo\PaymentGateway\Helpers\Logger;
use MichelMelo\PaymentGateway\Helpers\PaymentWidget;
use MichelMelo\PaymentGateway\Helpers\Utils;
use MichelMelo\PaymentGateway\Interfaces\PaymentMethodInterface;

class CardService implements PaymentMethodInterface
{
    protected $payment_type;
    protected $paymentMethod = ['CARD'];
    protected $value;
    protected $order_id;
    protected $currency;
    protected $transactionID = null;
    protected $url;

    private $apiEndpoint = 'api/v1/payments';

    public function __construct($url)
    {
        $this->url         = $url;
    }

    public function processPayment(array $paymentData): array
    {
        // Monta o corpo da requisição
        $body = [
            'merchant' => [
                'terminalId'            => $paymentData['terminalId'],
                'channel'               => 'web',
                'merchantTransactionId' => $paymentData['order_id'],
            ],
            'customer'    => $paymentData['customer'],
            'transaction' => [
                'transactionTimestamp' => date("Y-m-d\TH:i:s.v\Z"),
                'description'          => "teste {$paymentData['order_id']} terminalId={$paymentData['terminalId']}",
                'moto'                 => false,
                'paymentType'          => $paymentData['payment_type'],
                'paymentMethod'        => $this->paymentMethod,
                'amount'               => [
                    'value'    => $paymentData['value'],
                    'currency' => $paymentData['currency'],
                ],
            ],
        ];

        // Monta os cabeçalhos da requisição
        $headers = [
            //'User-Agent'      => $this->UserAgent,
            'Accept'          => 'application/json',
            'Content-Type'    => 'application/json',
            'Authorization'   => 'Bearer ' . $paymentData['bearerToken'],
            'X-IBM-Client-Id' => $paymentData['clientId'],
        ];

        Logger::log('sendRequest... ');

        try {
            // Envia a requisição para o endpoint
            $response = $this->sendRequest('POST', $this->apiEndpoint, [
                'headers' => $headers,
                'body'    => json_encode($body),
            ]);
            //Debug::printRequest('response', print_r($response, true));

            if ($response['returnStatus']['statusMsg'] !== 'Success') {
                throw new PaymentException('Failed to process CARD payment: ' . $response['message']);
            }

            return $response;
        } catch (\Exception $e) {
            throw new PaymentException('An error occurred while processing the CARD payment: ' . $e->getMessage());
        }
    }

    public function refundPayment(string $transactionId, float $amountValue, string $amountCurrency, array $data = []): array
    {
        $endpoint = $this->apiEndpoint . '/' . $transactionId . '/refund';

        // Monta os cabeçalhos conforme o exemplo do curl
        $headers = [
            'Accept'          => 'application/json, text/javascript, */*; q=0.01',
            'Content-Type'    => 'application/json',
            'Authorization'   => 'Bearer ' . $data['bearerToken'],
            'X-IBM-Client-Id' => $data['clientId'],
        ];

        // Monta o corpo da requisição conforme o exemplo do curl
        $body = [
            'merchant' => [
                'terminalId'            => $data['terminalId'],
                'channel'               => $data['channel'] ?? 'arzacodajie',
                'merchantTransactionId' => $data['merchantTransactionId'] ?? '',
            ],
            'transaction' => [
                'amount' => [
                    'value'    => $amountValue,
                    'currency' => $amountCurrency,
                ],
                'description' => $data['description'] ?? '',
                'transactionTimestamp' => $data['transactionTimestamp'] ?? '',
                'originalTransaction' => [
                    'id'       => $data['originalTransactionId'] ?? '',
                    'datetime' => $data['originalTransactionDatetime'] ?? '',
                ],
            ],
        ];

        $response = $this->sendRequest('POST', $endpoint, [
            'headers' => $headers,
            'body'    => json_encode($body),
        ]);
        Logger::log('response data: ' . json_encode($response)); // Log

        if (!isset($response['returnStatus']) || $response['returnStatus']['statusMsg'] !== 'Success') {
            throw new PaymentException('Failed to refund CARD payment: ' . ($response['message'] ?? 'Unknown error'));
        }

        return $response;
    }

    public function getPaymentStatus(string $transactionId, string $bearerToken, string $clientId): array
    {
        // Valida os dados de entrada
        if (empty($transactionId) || empty($bearerToken) || empty($clientId)) {
            throw new PaymentException('Invalid parameters provided for payment status check.');
        }

        // Monta o endpoint
        $endpoint = $this->apiEndpoint . '/' . $transactionId . '/status';
        $headers  = [
            'Authorization'   => 'Bearer ' . $bearerToken,
            'X-IBM-Client-Id' => $clientId,
            'Accept'          => 'application/json',
            'Content-Type'    => 'application/json',
        ];
        $options = [
            'headers' => $headers,
        ];
        $response = $this->sendRequest('GET', $endpoint, $options);
        Logger::log('response data: ' . json_encode($response)); // Log

        return $response;
    }

    public function validatePayment(array $paymentData): bool
    {
        // Validação dos dados de pagamento
        if (empty($paymentData['payment_type']) || empty($paymentData['value']) || empty($paymentData['currency']) || empty($paymentData['order_id'])) {
            throw new PaymentException('Invalid CARD payment data.');
        }

        return true; // Retorna true se os dados forem válidos
    }

    private function validatePaymentData(array $paymentData): void
    {
        if (empty($paymentData['payment_type']) || empty($paymentData['value']) || empty($paymentData['currency']) || empty($paymentData['order_id'])) {
            throw new PaymentException('Invalid payment data provided.');
        }

        $this->payment_type = $paymentData['payment_type'];
        $this->value        = $paymentData['value'];
        $this->currency     = $paymentData['currency'];
        $this->order_id     = $paymentData['order_id'];
    }

    private function sendRequest(string $method, string $endpoint, array $options = []): array
    {
        $url = $this->url . $endpoint;

        Logger::log('options: ' . json_encode($options));

        try {
            // Use Guzzle para fazer a requisição HTTP
            $client   = new \GuzzleHttp\Client();
            $response = $client->request($method, $url, $options);

            // Decodifica a resposta JSON
            $responseBody = json_decode($response->getBody()->getContents(), true);

            Logger::log('responseBody: ' . json_encode($responseBody));

            // Retorna a resposta decodificada
            return $responseBody;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Loga o erro e lança uma exceção personalizada
            Logger::log('HTTP Request failed: ' . $e->getMessage());

            throw new PaymentException('HTTP Request failed: ' . $e->getMessage());
        }
    }
}
