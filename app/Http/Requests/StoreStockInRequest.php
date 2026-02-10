<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockInRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'description' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Barang wajib dipilih.',
            'product_id.exists' => 'Barang tidak ditemukan.',
            'qty.required' => 'Jumlah barang masuk wajib diisi.',
            'qty.integer' => 'Jumlah barang masuk harus berupa angka.',
            'qty.min' => 'Jumlah barang minimal 1',
            'description.max' => 'Deskripsi maksimal 255 karakter.',
        ];
    }
}
