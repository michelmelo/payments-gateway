<?php

namespace MichelMelo\PaymentGateway\Helpers;

class Logger
{
    private static $enabled = true; // Controle para ativar/desativar o log
    private static $logFile = __DIR__ . '/../../logs/payment-gateway.log';

    /**
     * Ativa o sistema de log.
     */
    public static function enable(): void
    {
        self::$enabled = true;
    }

    /**
     * Desativa o sistema de log.
     */
    public static function disable(): void
    {
        self::$enabled = false;
    }

    /**
     * Registra uma mensagem no log.
     *
     * @param string $message
     * @param string|null $file Caminho do arquivo de log (opcional)
     */
    public static function log(string $message, string $file = null): void
    {
        if (! self::$enabled) {
            return;
        }

        $timestamp        = date('c'); // ISO 8601
        $formattedMessage = "{$timestamp} {$message}\n";
        $logFile = $file ?? self::$logFile;

        file_put_contents($logFile, $formattedMessage, FILE_APPEND);
    }
}
