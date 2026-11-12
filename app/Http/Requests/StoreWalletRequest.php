<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWalletRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:50', Rule::in(['Fisik', 'E-Wallet', 'Bank', 'Lainnya', 'cash', 'ewallet', 'bank', 'other'])],
            'initial_balance' => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama dompet wajib diisi.',
            'name.max' => 'Nama dompet tidak boleh lebih dari 255 karakter.',
            'type.required' => 'Jenis dompet wajib dipilih.',
            'type.in' => 'Jenis dompet yang dipilih tidak valid.',
            'initial_balance.required' => 'Saldo awal wajib diisi.',
            'initial_balance.numeric' => 'Saldo awal harus berupa angka.',
            'initial_balance.min' => 'Saldo awal tidak boleh bernilai negatif.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'nama dompet',
            'type' => 'jenis dompet',
            'initial_balance' => 'saldo awal',
        ];
    }
}
