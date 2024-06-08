<?php

namespace App\Http\Resources\Expense;

use App\Http\Resources\AcademicClass\AcademicClassResource;
use App\Http\Resources\AcademicSession\AcademicSessionResource;
use App\Http\Resources\Campus\CampusResource;
use App\Http\Resources\ExpenseItem\ExpenseItemCollection;
use App\Http\Resources\ExpenseTemplate\ExpenseTemplateResource;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\User\UserResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends SuccessResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'expense_no' => $this->expense_no,
            'expense_date' => $this->expense_date,
            "campus_id" =>  $this->campus_id ,
            'user_id' => $this->user_id,
            'academic_session_id' => $this->academic_session_id,
            'total_amount' => $this->total_amount,
            'paid_amount' => $this->paid_amount,
            'balance_amount' => $this->balance_amount,
            'payment_mode' => $this->payment_mode,
            'paid_amount' => $this->paid_amount,
            "academic_session" => new AcademicSessionResource($this->whenLoaded('academic_session')),
            "campus" => new CampusResource($this->whenLoaded('campus')),
             "user" => new UserResource($this->whenLoaded('user')),
            "expense_items" => new  ExpenseItemCollection($this->whenLoaded('expense_items')),
        ];
    }
}

