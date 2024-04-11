<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeTemplateDetails\StoreFeeTemplateDetailsRequest;
use App\Http\Requests\FeeTemplateDetails\UpdateFeeTemplateDetailsRequest;
use App\Http\Resources\FeeTemplateDetails\FeeTemplateDetailsCollection;
use App\Http\Resources\FeeTemplateDetails\FeeTemplateDetailsResource;
use App\Models\FeeTemplateDetails;
use Illuminate\Http\Request;

class FeeTemplateDetailsController extends Controller
{
    protected $userLoader=['fee_head'];

    public function index(Request $request)
    {

        $message=[];

        if(!$request->has('fee_template_id')){
           array_push($message,'Please provide fee template');
        }

        if($message){
            return response()->json(
                [
                   'status'=>false,
                   'message' => $message
                ]
           , 400);
        }
        return new FeeTemplateDetailsCollection(
            FeeTemplateDetails::with($this->userLoader)
            ->where('fee_template_id',$request->input('fee_template_id'))
            ->get());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeTemplateDetailsRequest $request)
    {
        $data = $request->validated();

        $fee_template_details = FeeTemplateDetails::create($data);
        return new FeeTemplateDetailsResource($fee_template_details->load($this->userLoader));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $fee_template_details= FeeTemplateDetails::find($id);
        return new FeeTemplateDetailsResource($fee_template_details->load($this->userLoader));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateFeeTemplateDetailsRequest $request, $id)
    {

        $data = $request->validated();
        $fee_template_details= FeeTemplateDetails::find($id);
        $fee_template_details->update($data);
        return new FeeTemplateDetailsResource($fee_template_details->load($this->userLoader));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( FeeTemplateDetails $fee_template_details)
    {
        $fee_template_details->delete();
        return response(null, 204);
    }
}
