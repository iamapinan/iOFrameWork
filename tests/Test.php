<?php
namespace iOTest;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

    public function testEnvExists() {
        $this->assertFileExists('.env-example');
    }
}