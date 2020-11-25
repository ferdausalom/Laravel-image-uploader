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
            'name'      => 'required',
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    // public function messages()
    // {
    //     return [
    //         'smallTitle' => 'Email is required!',
    //         'longTitle'  => 'Name is required!',
    //         'image'      => 'Password is required!'
    //     ];
    // }
}
