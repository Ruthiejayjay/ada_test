<?php

namespace App\Http\Requests;

use App\Enums\TicketStockEnum;
use App\Enums\TicketTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreEventTicketRequest extends FormRequest
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
            'description' => 'required|string',
            'name' => 'required|string',
            'ticket_type' => ['required', new Enum(TicketTypeEnum::class)],
            'ticket_stock' => ['required', new Enum(TicketStockEnum::class)],
            'no_of_stock' => 'numeric',
            'purchase_limit' => 'numeric',
            'price' => 'required|numeric',
        ];
    }
}
