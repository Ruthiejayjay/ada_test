<?php

namespace App\Http\Requests;

use App\Enums\EventCategoryEnum;
use App\Enums\EventFrequencyEnum;
use App\Enums\EventTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateEventRequest extends FormRequest
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
            'location' => 'string',
            'location_tip' => 'string',
            'event_type' => ['required', new Enum(EventTypeEnum::class)],
            'virtual_meet_link' => 'string',
            'event_categories' => ['required', new Enum(EventCategoryEnum::class)],
            'custom_url' => 'string|required',
            'event_frequency' => ['required', new Enum(EventFrequencyEnum::class)],
            'start_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:time_start',
            'end_date' => 'required|date',
            'twitter_url' => 'required|string',
            'facebook_url' => 'required|string',
            'instagram_url' => 'required|string',
        ];
    }
}
