<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Concerns\BillDataProvider;

class TextToJsonTest extends TestCase
{
    use BillDataProvider;

    public function testParseTextContentToArray()
    {
        $file = $this->app->resourcePath('data/sample.txt');

        $contents = json_decode(file_get_contents($file), true);

        $this->assertSame($this->sampleData(), $contents);
    }

    public function testParseInvalidJson()
    {
        $file = $this->app->resourcePath('data/error.txt');

        $contents = json_decode(file_get_contents($file), true);

        $this->assertNull($contents);
    }
}
