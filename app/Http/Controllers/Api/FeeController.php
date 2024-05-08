<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fee\StoreFeeRequest;
use App\Http\Requests\Fee\UpdateFeeRequest;
use App\Http\Resources\Fee\FeeCollection;
use App\Http\Resources\Fee\FeeResource;
use App\Models\Fee;
use App\Models\FeeItem;
use App\Models\StudentSession;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new FeeCollection(Fee::all());
    }
    public function FeesByStudentSession(StudentSession $studentSession)
    {

        $fees=Fee::with('fee_template','academic_session')
        ->where('student_id',$studentSession->student_id)
        ->where('academic_session_id',$studentSession->academic_session_id)
        ->orderBy('id','desc')
        ->get();
        return new FeeCollection($fees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeRequest $request)
    {
       // dd($request->all());
    //    \DB::transaction(function () use ($request) {
        $data = $request->validated();
        $data['fee_no']=$this->GetFeeNo($data['academic_session_id']);
        $fee = Fee::create($data);

        foreach($data['fee_items'] as $key=>$feeItem){
            $fee_item= new FeeItem();
            $fee_item->fee_id=$fee->id;
            $fee_item->fee_head_id=$feeItem['fee_head_id'];
            $fee_item->quantity=$feeItem['quantity'];
            $fee_item->amount=$feeItem['amount'];
            $fee_item->total_amount=$feeItem['total_amount'];
           // dd($fee_items);
            $fee_item->save();
        }
        return new FeeResource($fee);
    //    });
       return response()->json(['error' => 'Check you input(s)'], 401);
    }
function GetFeeNo($academic_session_id){
    $countFees=Fee::where('academic_session_id',$academic_session_id)->count();
    return $countFees+1;

}
    /**
     * Display the specified resource.
     */
    public function show(Fee $fee)
    {
        return new FeeResource($fee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeeRequest $request, Fee $fee)
    {
        $data = $request->validated();
        $fee->update($data);
        return new FeeResource($fee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Fee $fee)
    {
        $fee->delete();
        return response(null, 204);
    }
}
