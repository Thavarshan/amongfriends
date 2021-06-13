<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Inertia\Inertia;
use App\Http\Requests\BillRequest;
use App\Http\Responses\BillResponse;
use App\Contracts\Actions\ParsesBillInformation;
use App\Contracts\Actions\CalculatesBillInfromation;

class BillController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Models\Bill                             $bill
     * @param \App\Contracts\Actions\ParsesBillInformation $parser
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill, ParsesBillInformation $parser)
    {
        return Inertia::render('Bills/Show', [
            'details' => $parser->parse($bill),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\BillRequest                   $request
     * @param \App\Contracts\Actions\CalculatesBillInfromation $calculator
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request, CalculatesBillInfromation $calculator)
    {
        $data = $request->has('billfile')
            ? file_get_contents($request->billfile)
            : $request->bill;

        $bill = $calculator->calculate(json_decode($data, true));

        return BillResponse::dispatch($bill);
    }
}
