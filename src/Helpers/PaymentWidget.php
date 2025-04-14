<?php

namespace MichelMelo\PaymentGateway\Helpers;


use MichelMelo\PaymentGateway\Helpers\Logger; // Adicionado

class PaymentWidget
{
    /**
     * Gera o script do widget de pagamento.
     *
     * @param string $transactionID
     * @param string $url
     * @return string
     */
    public static function widget(string $transactionID, string $url = ''): string
    {
        return '<script src="' . $url . '/assets/js/widget.js?id=' . $transactionID . '"></script>';
    }

    /**
     * Gera o formulário de pagamento.
     *
     * @param string $formContext
     * @param string $formConfig
     * @return string
     */
    public static function form(string $formContext, string $formConfig): string
    {
        Logger::log("Payment data: " . json_encode($formContext));
        Logger::log("Payment data: " . json_encode($formConfig));
        return "<form class='paymentSPG' spg-context='" . $formContext . "' spg-config='" . $formConfig . "'></form>";
    }
}