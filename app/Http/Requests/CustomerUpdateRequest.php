<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // 'email' yok!
            'phone' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
