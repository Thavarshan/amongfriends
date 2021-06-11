<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Inertia\Inertia;
use App\Http\Requests\BillRequest;
use App\Http\Responses\BillResponse;
use App\Actions\Billing\CalculateBill;

class BillController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Bill $bill
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        return Inertia::render('Bills/Show', [
            'bill' => $bill->load('charges')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\BillRequest     $request
     * @param \App\Actions\Billing\CalculateBill $calculator
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request, CalculateBill $calculator)
    {
        $data = $request->has('billfile')
            ? file_get_contents($request->billfile)
            : $request->bill;

        $bill = $calculator->calculate(json_decode($data, true));

        return BillResponse::dispatch($bill);
    }
}
