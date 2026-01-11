<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePassengerDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'passengers' => 'required|array|min:1',
            'passengers.*.name' => 'required',
            'passengers.*.date_of_birth' => 'required',
            'passengers.*.nationality' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'passengers.*.name' => 'Passenger Name',
            'passengers.*.date_of_birth' => 'Passenger Date of Birth',
            'passengers.*.nationality' => 'Passenger Nationality',
        ];
    }

    public function messages()
    {
        return [
            'passengers.*.name.required' => ':attribute field is required',
            'passengers.*.date_of_birth.required' => ':attribute field is required',
            'passengers.*.nationality.required' => ':attribute field is required',
        ];
    }
}
