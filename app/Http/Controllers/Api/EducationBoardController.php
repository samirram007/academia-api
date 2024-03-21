<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationBoard\StoreEducationBoardRequest;
use App\Http\Requests\EducationBoard\UpdateEducationBoardRequest;
use App\Http\Resources\EducationBoard\EducationBoardCollection;
use App\Http\Resources\EducationBoard\EducationBoardResource;
use App\Models\EducationBoard;
use Illuminate\Http\Request;

class EducationBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return new EducationBoardCollection(EducationBoard::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEducationBoardRequest $request)
    {
        $data = $request->validated();
        $educationBoard = EducationBoard::create($data);
        return new EducationBoardResource($educationBoard);
    }

    /**
     * Display the specified resource.
     */
    public function show(EducationBoard $educationBoard)
    {

        return new EducationBoardResource($educationBoard);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEducationBoardRequest $request, EducationBoard $educationBoard)
    {
        $data = $request->validated();
        $educationBoard->update($data);
        return new EducationBoardResource($educationBoard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EducationBoard $educationBoard)
    {
        $educationBoard->delete();
        return response(null, 204);
    }
}
