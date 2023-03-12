<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepFourRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "donation_duration" => "required",
            'donation_amount' => ['required', 'min:1000000', 'numeric', 'regex:/^\d+000$/'],
            "donation_detail" => ["required", "regex:/\b\w{1,}\b(?:\s+\b\w{1,}\b){5,}/"],
        ];
    }

    public function messages(): array
    {
        return [
            'donation_duration.required' => 'Durasi untuk galang dana wajib diisi',
            'donation_amount.numeric' => 'Biaya harus berupa angka.',
            'donation_amount.required' => 'Jumlah kebutuhan donasi wajib diisi.',
            'donation_amount.regex' => 'Harus kelipatan 1000.',
            'donation_amount.min' => 'Minimal donasi Rp 1,000,000 .',
            'donation_detail.required' => 'Detail donasi wajib diisi.',
            'donation_detail.regex' => 'Detail donasi paling tidak memiliki 12 kata.'
        ];
    }
}
