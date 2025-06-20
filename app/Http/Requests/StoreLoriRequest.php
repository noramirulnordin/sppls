<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoriRequest extends FormRequest
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
            'no_pendaftaran' => 'required|string|max:20|unique:loris,no_pendaftaran',
            'pembeli_id'     => 'required|exists:pembelis,id',
            'kapasiti'       => 'nullable|numeric|min:0',
            'jenis'          => 'nullable|string|max:50',
            'kawasan_id'     => 'nullable|exists:kawasans,id',
        ];
    }
}
