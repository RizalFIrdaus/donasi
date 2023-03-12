<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepFiveRequest extends FormRequest
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
            "donation_title" => "required|min:6",
            "donation_story" => ["required", "min:100"],
            "donation_support" => ["required", "min:32"],
            "donation_photo" => "image|mimes:jpeg,jpg,png|max:1024"
        ];
    }

    public function messages(): array
    {
        return [
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
