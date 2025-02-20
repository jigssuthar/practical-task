<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true; // You can add authorization logic here
    }

    public function rules()
    {
        return [
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string',
        ];
    }
}
