<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideStoreRequest extends FormRequest
{
    //Command to make a request class
    // php artisan make:request SlideStoreRequest
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
            'name'  => 'required',
            'image' => ['image', 'mimes:jpg,jpeg,png,gif', 'max:3072']
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
    */
    public function messages()
    {
        return [
            'image.max' => 'For best result, the image may not be greater than 3 Megabytes.'
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
}
