<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoriRequest extends FormRequest
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
            'no_pendaftaran' => 'required|string|max:255',
            'jenis'          => 'nullable|string|max:255',
            'kapasiti'       => 'nullable|integer',
            'pembeli_id'     => 'required|exists:pembelis,id',
            'kawasan_id'     => 'required|array',
            'kawasan_id.*'   => 'exists:kawasans,id',
        ];
    }
}
