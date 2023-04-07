<?php

namespace App\Http\Requests;

use App\Enums\TransactionStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreTicketTransactionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'first_name' => 'string',
            'last_name' => 'string',
            'email'=> 'string',
            'fee' => 'required|numeric',
            'status' => new Enum(TransactionStatusEnum::class),
            'no_of_purchase' => 'required|numeric',
            'amount' => 'required|numeric'
        ];
    }
}
