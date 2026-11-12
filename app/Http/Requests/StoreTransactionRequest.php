<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
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
            'wallet_id' => [
                'required',
                'integer',
                Rule::exists('wallets', 'id')->where(fn ($query) => $query->where('user_id', $this->user()?->id)),
            ],
            'amount' => ['required', 'numeric', 'gt:0'],
            'transaction_date' => ['required', 'date'],
            'description' => ['required', 'string', 'max:255'],
            'type' => ['sometimes', 'required', 'string', Rule::in(['income'])],
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
            'wallet_id.required' => 'Dompet tujuan pemasukan wajib dipilih.',
            'wallet_id.exists' => 'Dompet yang dipilih tidak valid atau bukan milik Anda.',
            'amount.required' => 'Nominal pemasukan wajib diisi.',
            'amount.numeric' => 'Nominal pemasukan harus berupa angka.',
            'amount.gt' => 'Nominal pemasukan harus lebih besar dari 0.',
            'transaction_date.required' => 'Tanggal transaksi wajib diisi.',
            'transaction_date.date' => 'Format tanggal transaksi tidak valid.',
            'description.required' => 'Deskripsi transaksi wajib diisi.',
            'description.max' => 'Deskripsi transaksi tidak boleh lebih dari 255 karakter.',
            'type.in' => 'Jenis transaksi hanya didukung untuk pemasukan (income).',
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
            'wallet_id' => 'dompet',
            'amount' => 'nominal',
            'transaction_date' => 'tanggal transaksi',
            'description' => 'deskripsi',
            'type' => 'jenis transaksi',
        ];
    }
}
