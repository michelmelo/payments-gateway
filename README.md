# Payment Gateway SDK

O **Payment Gateway SDK** é uma biblioteca PHP que permite integrar diversos métodos de pagamento, como MBWay, Multibanco, Cartão de Crédito, XPay, Blik e Pay By Link, em aplicações PHP e frameworks populares como WordPress, PrestaShop, Laravel e Magento.

## Requisitos

- PHP 7.4 ou superior
- Composer
- Extensão `curl` habilitada no PHP

## Instalação

Você pode instalar o SDK via Composer:

```bash
composer require michelmelo/payments-gateway
```

## Configuração

Certifique-se de carregar o autoloader do Composer no seu projeto:

```php
require 'vendor/autoload.php';
```

## Uso

### Inicializando o SDK

Para começar, crie uma instância da classe `PaymentGateway`:

```php
use MichelMelo\PaymentGateway\PaymentGateway;

$paymentGateway = new PaymentGateway(
    'your-bearer-token',
    'your-client-id',
    'your-terminal-id',
    'PURS', // ou 'AUTH'
    'https://api.paymentgateway.com'
);
```

### Processando Pagamentos

O método `processPayment` permite processar pagamentos com base no método de pagamento desejado. Aqui está um exemplo para cada método:

#### MBWay

```php
<?php
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
    'amount' => 10.00,
    'currency' => 'EUR',
];

$response = $paymentGateway->processPayment('mbway', $data, $customer);
```

### Exibindo o Widget ou Formulário de Pagamento

Após processar o pagamento, você pode usar a classe `PaymentWidget` para exibir o widget ou o formulário de pagamento.

#### Exibindo o Widget

Use o método `widget` para gerar o script do widget de pagamento:

```php
use MichelMelo\PaymentGateway\Helpers\PaymentWidget;

echo PaymentWidget::widget($response['transactionId'], 'https://example.com');
```

Saída esperada:
```html
<script src="https://example.com/assets/js/widget.js?id=123456789"></script>
```

#### Exibindo o Formulário

Use o método `form` para gerar o formulário de pagamento:

```php
echo PaymentWidget::form('checkout', '{"key":"value"}');
```

Saída esperada:
```html
<form class='paymentSPG' spg-context='checkout' spg-config='{"key":"value"}'></form>
```

#### Multibanco

```php
<?php
$customer = [
    'customerInfo' => [
        'customerName'    => 'John Smith',
        'customerEmail'   => 'John@email.com',
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
    'entity' => '12345',
    'reference' => '123456789',
    'amount' => 10.00,
];

$response = $paymentGateway->processPayment('multibanco', $data, $customer);
```

#### Cartão de Crédito

```php
$customer = []; // Se não houver dados específicos de cliente, use um array vazio
$data = [
    'card_number' => '4111111111111111',
    'expiry_date' => '12/25',
    'cvv' => '123',
    'amount' => 10.00,
];

$response = $paymentGateway->processPayment('card', $data, $customer);
```

#### XPay

```php
$customer = [];
$data = [
    'xpay_token' => 'your-xpay-token',
    'amount' => 10.00,
];

$response = $paymentGateway->processPayment('xpay', $data, $customer);
```

#### Blik

```php
$customer = [];
$data = [
    'blik_code' => '123456',
    'amount' => 10.00,
];

$response = $paymentGateway->processPayment('blik', $data, $customer);
```

#### Pay By Link

```php
$customer = [];
$data = [
    'email' => 'customer@example.com',
    'amount' => 10.00,
];

$response = $paymentGateway->processPayment('paybylink', $data, $customer);
```

### Tratamento de Exceções

Se um método de pagamento não for suportado ou ocorrer um erro, uma exceção `PaymentException` será lançada. Certifique-se de tratar as exceções adequadamente:

```php
use MichelMelo\PaymentGateway\Exceptions\PaymentException;

try {
    $response = $paymentGateway->processPayment('mbway', $data);
    echo "Pagamento processado com sucesso!";
} catch (PaymentException $e) {
    echo "Erro ao processar pagamento: " . $e->getMessage();
}
```

## Testes

Para executar os testes, use o seguinte comando:

```bash
composer test
```

## Contribuição

Sinta-se à vontade para contribuir com melhorias para este SDK. Faça um fork do repositório, crie uma branch para sua funcionalidade ou correção e envie um pull request.

## Licença

Este projeto está licenciado sob a licença MIT. Consulte o arquivo `LICENSE` para mais detalhes.