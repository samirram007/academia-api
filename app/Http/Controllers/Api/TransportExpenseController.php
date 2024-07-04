<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransportExpense\StoreTransportExpenseRequest;
use App\Http\Requests\TransportExpense\UpdateTransportExpenseRequest;
use App\Http\Resources\TransportExpense\TransportExpenseCollection;
use App\Http\Resources\TransportExpense\TransportExpenseResource;
use App\Models\AcademicSession;
use App\Models\TransportExpense;
use App\Models\TransportExpenseItem;
use Illuminate\Http\Request;

class TransportExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userLoader = ['campus', 'academic_session',
     'transport_expense_items', 'transport_expense_items.expense_head'];
    public function index(Request $request)
    {
        $message = [];
// dd( TransportExpense::all());
        if (!$request->has('campus_id')) {
            array_push($message, 'Please provide campus_id');
        }
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

            // ->where('campus_id', $request->input('campus_id'))
            // ->where('academic_session_id', $request->input('academic_session_id'))
        $expenses = TransportExpense::with($this->userLoader)
            ->where('campus_id',$request->input('campus_id'))
            ->where('academic_session_id',$request->input('academic_session_id'))
            ->whereBetween('expense_date',[$request->input('from'),$request->input('to')])
            ->get();
        //dd($expenses);
        return new TransportExpenseCollection($expenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransportExpenseRequest $request)
    {
        //dd($request->all());
        //\DB::transaction(function () use ($request) {
            $data = $request->validated();
            $academicSession = AcademicSession::where('id', $request['academic_session_id'])->first();
            $data['expense_no'] = $academicSession->current_transport_expense_no;
            $expense = TransportExpense::create($data);
            //  dd($data['expense_items']);
            foreach ($data['transport_expense_items'] as $key => $expenseItem) {

                $expense_item = new TransportExpenseItem();
                $expense_item->transport_expense_id = $expense->id;
                $expense_item->expense_head_id = $expenseItem['expense_head_id'];
                $expense_item->quantity = $expenseItem['quantity'];

                $expense_item->amount = $expenseItem['amount'];
                $expense_item->total_amount = $expenseItem['total_amount'];
                // dd($expense_items);
                $expense_item->save();
            }
            $academicSession->current_expense_no = $academicSession->current_expense_no+1;
            $academicSession->update();
            return new TransportExpenseResource($expense->load($this->userLoader));
       // });
        return response()->json(['error' => 'Check you input(s)'], 401);
    }
    public function GetExpenseNo($academic_session_id)
    {
        $academicSession = AcademicSession::where('id', $academic_session_id)->first();
        $current_transport_expense_no = $academicSession;

        return $current_transport_expense_no;

    }

    /**
     * Display the specified resource.
     */
    public function show(TransportExpense $expense)
    {
        return new TransportExpenseResource($expense->load($this->userLoader));
        $expense = TransportExpense::with('academic_session', 'user', 'campus',
            'expense_items', 'expense_items.expense_head', 'campus.address', 'campus.logo_image')->find($expense->id);
        return new TransportExpenseResource($expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransportExpenseRequest $request, TransportExpense $expense)
    {

       // \DB::transaction(function () use ($request, $expense) {
            $data = $request->validated();
            $expense->update($data);

            foreach ($data['expense_items'] as $key => $expenseItem) {
                $expense_item = TransportExpenseItem::where('expense_id', $expense->id)->where('expense_head_id', $expenseItem['expense_head_id'])->first();
                if (!$expense_item) {
                    $expense_item = new TransportExpenseItem();
                }

                $expense_item->expense_id = $expense->id;
                $expense_item->expense_head_id = $expenseItem['expense_head_id'];
                $expense_item->quantity = $expenseItem['quantity'];
                $expense_item->amount = $expenseItem['amount'];
                $expense_item->total_amount = $expenseItem['total_amount'];
                // dd($expense_items);
                $expense_item->save();
            }
            return new TransportExpenseResource($expense->load($this->userLoader));
      //  });
        return response()->json(['error' => 'Check you input(s)'], 401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportExpense $expense)
    {
        $expense->delete();
        return response(null, 204);
    }
}
