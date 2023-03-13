<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepThreeRequest extends FormRequest
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
            "inpatient" => "required",
            "hospital" => "required",
            "effort" => "required|min:12",
            "resource" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            'inpatient.required' => 'Status rawat inap wajib diisi.',
            'hospital.required' => 'Nama rumah sakit wajib diisi.',
            'effort.required' => 'Upaya pengobatan ini wajib diisi.',
            'effort.min' => 'Upaya pengobatan ini harus memiliki minimal 12 karakter.',
            'resource.required' => 'Sumber biaya yang digunakan wajib diisi.'
        ];
    }
}
