<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MedicalGalangDanaRequestForm extends FormRequest
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
            "pasien" => "required",
            "user_phone" => "required",
            "patient_name" => "required|string|min:3|max:42",
            "patient_diagnose" => "required",
            "inpatient" => "required",
            "hospital" => "required",
            "effort" => "required|min:12",
            "resource" => "required",
            "donation_duration" => "required",
            'donation_amount' => ['required', 'min:1000000', 'numeric', 'regex:/^\d+000$/'],
            "donation_detail" => ["required", "regex:/\b\w{1,}\b(?:\s+\b\w{1,}\b){5,}/"],
            "donation_title" => "required|min:6",
            "donation_story" => ["required", "min:100"],
            "donation_support" => ["required", "min:32"],
            "donation_photo" => "image|mimes:jpeg,jpg,png|max:1024"
        ];
    }
    public function messages(): array
    {
        return [
            "pasien.required" => "Status pasien harus diisi",
            'user_phone.required' => 'Nomor telepon wajib diisi.',
            'patient_name.required' => 'Nama pasien wajib diisi.',
            'patient_name.string' => 'Nama pasien harus berupa string.',
            'patient_name.min' => 'Nama pasien minimal 3 karakter.',
            'patient_name.max' => 'Nama pasien maksimal 42 karakter.',
            'patient_diagnose.required' => 'Diagnosa pasien wajib diisi.',
            'inpatient.required' => 'Status rawat inap wajib diisi.',
            'hospital.required' => 'Nama rumah sakit wajib diisi.',
            'effort.required' => 'Upaya pengobatan ini wajib diisi.',
            'effort.min' => 'Upaya pengobatan ini harus memiliki minimal 12 karakter.',
            'resource.required' => 'Sumber biaya yang digunakan wajib diisi.',
            'donation_duration.required' => 'Durasi untuk galang dana wajib diisi',
            'donation_amount.numeric' => 'Biaya harus berupa angka.',
            'donation_amount.required' => 'Jumlah kebutuhan donasi wajib diisi.',
            'donation_amount.regex' => 'Harus kelipatan 1000.',
            'donation_amount.min' => 'Minimal donasi Rp 1,000,000 .',
            'donation_detail.required' => 'Detail donasi wajib diisi.',
            'donation_detail.regex' => 'Detail donasi paling tidak memiliki 12 kata.',
            "donation_title.required" => "Title campaign harus diisi.",
            "donation_title.min" => "Title campaign minimal 6 karakter.",
            "donation_story.required" => "Cerita campaign harus diisi.",
            "donation_story.min" => "Minimal 100 karakter.",
            "donation_support.required" => "Ajakan campaign harus diisi.",
            "donation_support.min" => "Minimal 32 karakter.",
            'photo.file' => 'File yang diunggah harus berupa gambar.',
            'photo.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'photo.max' => 'Ukuran gambar maksimum adalah 1MB.',
        ];
    }
}
