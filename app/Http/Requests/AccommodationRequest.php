<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationRequest extends FormRequest
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
            'name' => 'min:5|max:30|required',
            'city_id' => 'required|integer',
            'category_id' => 'required|integer',
            'type_id' => 'required|integer',
            'description' => 'required',
            'capacity' => 'required|integer',
            'deposit' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'website' => 'url|required',
            'address' => 'min:5|max:30|required',
            'youtube_link' => 'url|required',
            'priority' => 'required|integer',
            'premium' => 'required|integer'
            //
        ];
    }
}
