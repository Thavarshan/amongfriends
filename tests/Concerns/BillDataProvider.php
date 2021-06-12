<?php

namespace Tests\Concerns;

trait BillDataProvider
{
    /**
     * Data provider.
     *
     * @return array|string
     */
    public function sampleData(bool $json = false)
    {
        $data = [
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
                'friends' => ['Liam', 'Tanu'],
            ],
        ];

        return $json ? json_encode($data) : $data;
    }

    /**
     * Data provider.
     *
     * @return array|string
     */
    public function sampleNestedData(bool $json = false)
    {
        $data = [
            [
                'day' => 1,
                'amount' => 50,
                'paid_by' => 'Tanu',
                'friends' => ['Kasun', 'Tanu'],
            ],
            [
                'day' => 2,
                'amount' => 200,
                'paid_by' => 'Kasun',
                'friends' => ['Kasun', ['Tanu', 'Ken', 'John'], 'Liam'],
            ],
            [
                'day' => 3,
                'amount' => 100,
                'paid_by' => 'Liam',
                'friends' => ['Liam', 'Tanu'],
            ],
        ];

        return $json ? json_encode($data) : $data;
    }
}
