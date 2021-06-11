<?php

namespace Tests\Feature;

use Tests\TestCase;

class TextToJsonTest extends TestCase
{
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

    /**
     * Data provider.
     *
     * @return array
     */
    public function sampleData(): array
    {
        return [
            [
                'day' => 1,
                'amount' => 50,
                'paid_by' => 'Tanu',
                'friends' => ['Kasun', 'Tanu'],
            ],
            [
                'day' => 2,
                'amount' => 100,
                'paid_by' => 'Kasun',
                'friends' => ['Kasun', 'Tanu', 'Liam'],
            ],
            [
                'day' => 3,
                'amount' => 100,
                'paid_by' => 'Liam',
                'friends' => ['Liam', 'Tanu',],
            ],
        ];
    }
}
