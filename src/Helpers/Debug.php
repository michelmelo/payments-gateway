<?php

namespace MichelMelo\PaymentGateway\Helpers;

class Utils
{
    public static function colouredString($string, $colour)
    {
        $colours = [
            'black'        => '0;30',
            'dark_gray'    => '1;30',
            'blue'         => '0;34',
            'light_blue'   => '1;34',
            'green'        => '0;32',
            'light_green'  => '1;32',
            'cyan'         => '0;36',
            'light_cyan'   => '1;36',
            'red'          => '0;31',
            'light_red'    => '1;31',
            'purple'       => '0;35',
            'light_purple' => '1;35',
            'brown'        => '0;33',
            'yellow'       => '1;33',
            'light_gray'   => '0;37',
            'white'        => '1;37',
        ];

        $colored_string = '';

        if (isset($colours[$colour])) {
            $colored_string .= "\033[" . $colours[$colour] . 'm';
        }

        $colored_string .= $string . "\033[0m";

        return $colored_string;
    }
}

class Debug
{
    public static $debugLog     = false;
    public static $debugLogFile = 'debug.log';

    public static function printRequest($method, $endpoint)
    {
        $cMethod = PHP_SAPI === 'cli'
            ? Utils::colouredString("{$method}:  ", 'light_blue')
            : "{$method}:  ";
        echo $cMethod . $endpoint . "\n";

        if (self::$debugLog) {
            file_put_contents(self::$debugLogFile, "{$method}:  {$endpoint}\n", FILE_APPEND | LOCK_EX);
        }
    }

    public static function printUpload($uploadBytes)
    {
        $dat = PHP_SAPI === 'cli'
            ? Utils::colouredString('→ ' . $uploadBytes, 'yellow')
            : '→ ' . $uploadBytes;
        echo $dat . "\n";

        if (self::$debugLog) {
            file_put_contents(self::$debugLogFile, "→ {$uploadBytes}\n", FILE_APPEND | LOCK_EX);
        }
    }

    public static function printHttpCode($httpCode, $bytes)
    {
        $output = PHP_SAPI === 'cli'
            ? Utils::colouredString("← {$httpCode} \t {$bytes}", 'green')
            : "← {$httpCode} \t {$bytes}";
        echo $output . "\n";

        if (self::$debugLog) {
            file_put_contents(self::$debugLogFile, "← {$httpCode} \t {$bytes}\n", FILE_APPEND | LOCK_EX);
        }
    }

    public static function printResponse($response, $truncated = false)
    {
        $res = PHP_SAPI === 'cli'
            ? Utils::colouredString('RESPONSE: ', 'cyan')
            : 'RESPONSE: ';

        if ($truncated && mb_strlen($response, 'utf8') > 1000) {
            $response = mb_substr($response, 0, 1000, 'utf8') . '...';
        }
        echo $res . $response . "\n\n";

        if (self::$debugLog) {
            file_put_contents(self::$debugLogFile, "RESPONSE: {$response}\n\n", FILE_APPEND | LOCK_EX);
        }
    }

    public static function printPostData($post)
    {
        $gzip = mb_strpos($post, "\x1f" . "\x8b" . "\x08", 0, 'US-ASCII') === 0;

        $dat = PHP_SAPI === 'cli'
            ? Utils::colouredString(($gzip ? 'DECODED ' : '') . 'DATA: ', 'yellow')
            : 'DATA: ';
        echo $dat . urldecode($gzip ? zlib_decode($post) : $post) . "\n";

        if (self::$debugLog) {
            file_put_contents(self::$debugLogFile, 'DATA: ' . urldecode($gzip ? zlib_decode($post) : $post) . "\n", FILE_APPEND | LOCK_EX);
        }
    }
}
