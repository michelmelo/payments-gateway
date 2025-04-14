<?php

use PHPUnit\Framework\TestCase;
use YourNamespace\Helpers\ConfigHelper;

class ConfigHelperTest extends TestCase
{
    protected $configHelper;

    protected function setUp(): void
    {
        $this->configHelper = new ConfigHelper();
    }

    public function testLoadConfig()
    {
        $config = $this->configHelper->loadConfig('path/to/config.php');
        $this->assertIsArray($config);
        $this->assertArrayHasKey('key', $config);
    }

    public function testGetConfigValue()
    {
        $this->configHelper->loadConfig('path/to/config.php');
        $value = $this->configHelper->getConfigValue('key');
        $this->assertEquals('expected_value', $value);
    }

    public function testInvalidConfigPath()
    {
        $this->expectException(Exception::class);
        $this->configHelper->loadConfig('invalid/path.php');
    }
}
