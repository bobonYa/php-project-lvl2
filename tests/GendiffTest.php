<?php

namespace Php\Package\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\genDiff;

class GendiffTest extends TestCase
{
    private $testData = [
        [
            'file1' => __DIR__ . '/fixtures/file1.json',
            'file2' => __DIR__ . '/fixtures/file2.json',
            'answer' => ' - follow: false
host: "hexlet.io"
 - proxy: "123.234.53.22"
 - timeout: 50
 + timeout: 20
 + verbose: true'
        ]
    ];

    public function testReverse(): void
    {
        $test = $this->testData[0];
        $this->assertEquals($test['answer'], genDiff($test['file1'], $test['file2']));
    }
}
