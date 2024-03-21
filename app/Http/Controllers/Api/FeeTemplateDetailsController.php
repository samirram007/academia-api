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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new FeeTemplateDetailsCollection(FeeTemplateDetails::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeTemplateDetailsRequest $request)
    {
        $data = $request->validated();
        $fee_template_details = FeeTemplateDetails::create($data);
        return new FeeTemplateDetailsResource($fee_template_details);
    }

    /**
     * Display the specified resource.
     */
    public function show(FeeTemplateDetails $fee_template_details)
    {
        return new FeeTemplateDetailsResource($fee_template_details);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeeTemplateDetailsRequest $request, FeeTemplateDetails $fee_template_details)
    {
        $data = $request->validated();
        $fee_template_details->update($data);
        return new FeeTemplateDetailsResource($fee_template_details);
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
