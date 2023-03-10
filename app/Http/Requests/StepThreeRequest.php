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
            "effort" => "required|regex:/\b\w{1,}\b(?:\s+\b\w{1,}\b){11,}/",
            "resource" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            'inpatient.required' => 'Status rawat inap wajib diisi.',
            'hospital.required' => 'Nama rumah sakit wajib diisi.',
            'effort.required' => 'Usaha yang dilakukan wajib diisi.',
            'effort.regex' => 'Usaha yang dilakukan harus memiliki minimal 12 kata.',
            'resource.required' => 'Sumber daya yang digunakan wajib diisi.'
        ];
    }
}
