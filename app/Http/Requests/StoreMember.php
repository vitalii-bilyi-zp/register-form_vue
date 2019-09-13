<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMember extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'birthdate' => 'required|date',
            'report' => 'required|string|max:100',
            'country_id' => 'required|integer|exists:countries,id',
            'phone' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:members',
        ];
    }
}
