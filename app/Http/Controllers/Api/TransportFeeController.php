<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransportFee\TransportFeeCollection;
use App\Models\Transport;
use App\Models\TransportFee;
use Illuminate\Http\Request;

class TransportFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $message = [];


        if (!$request->has('academic_session_id')) {
            array_push($message, 'Please provide academic_session_id');
        }
        if ($message) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $message,
                ]
                , 400);
        }
        $fees = TransportFee::with('academic_session', 'user', 'transport', 'campus',
            'student_session', 'student_session.campus', 'student_session.academic_class',
            'student_session.academic_session', 'student_session.section',

            'transport_fee_items', 'transport_fee_items.fee_head', 'transport_fee_items.transport_fee_item_months',
            'transport_fee_items.transport_fee_item_months.month',
            'campus', 'campus.school', 'campus.school.address', 'campus.school.logo_image')
            ->where('academic_session_id', $request->academic_session_id)
            ->whereBetween('fee_date', [$request->input('from'), $request->input('to')])
            ->orderBy('id', 'desc')
            ->get();

        return new TransportFeeCollection($fees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TransportFee $transportFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransportFee $transportFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportFee $transportFee)
    {
        //
    }
}
