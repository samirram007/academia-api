<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeTemplate\StoreFeeTemplateRequest;
use App\Http\Requests\FeeTemplate\UpdateFeeTemplateRequest;
use App\Http\Resources\FeeTemplate\FeeTemplateCollection;
use App\Http\Resources\FeeTemplate\FeeTemplateResource;
use App\Models\FeeTemplate;
use Illuminate\Http\Request;

class FeeTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userLoader=['campus','academic_session','academic_class','fee_template_items','fee_template_items.fee_head'];

    public function index(Request $request)
    {

        $message=[];

        if(!$request->has('academic_session_id')){
           array_push($message,'Please provide academic session');
        }
        if(!$request->has('academic_class_id')){
            array_push($message,'Please provide academic Class');
        }
        if($message){
            return response()->json(
                [
                   'status'=>false,
                   'message' => $message
                ]
           , 400);
        }

        $thisData= new FeeTemplateCollection(
            FeeTemplate::with($this->userLoader)
            ->where('academic_session_id',$request->input('academic_session_id'))
            ->where('academic_class_id',$request->input('academic_class_id'))
            ->get());

            return  $thisData;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeTemplateRequest $request)
    {
        $data = $request->validated();
        $fee_template = FeeTemplate::create($data);
        return new FeeTemplateResource($fee_template);
    }

    /**
     * Display the specified resource.
     */
    public function show(FeeTemplate $fee_template)
    {
        return new FeeTemplateResource($fee_template);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeeTemplateRequest $request, FeeTemplate $fee_template)
    {
        $data = $request->validated();
        $fee_template->update($data);
        return new FeeTemplateResource($fee_template);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( FeeTemplate $fee_template)
    {
        $fee_template->delete();
        return response(null, 204);
    }
}
