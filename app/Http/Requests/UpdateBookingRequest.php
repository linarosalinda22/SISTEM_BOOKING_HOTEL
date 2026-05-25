<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tamu_id' => 'required|exists:tamuses,id',
            'kamar_id' => 'required|exists:kamar,id',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'tamu_id.required' => 'Pilih tamu terlebih dahulu',
            'tamu_id.exists' => 'Tamu yang dipilih tidak valid',
            'kamar_id.required' => 'Pilih kamar terlebih dahulu',
            'kamar_id.exists' => 'Kamar yang dipilih tidak valid',
            'tanggal_checkin.required' => 'Tanggal check-in harus diisi',
            'tanggal_checkin.date' => 'Format tanggal check-in tidak valid',
            'tanggal_checkout.required' => 'Tanggal check-out harus diisi',
            'tanggal_checkout.date' => 'Format tanggal check-out tidak valid',
            'tanggal_checkout.after' => 'Tanggal check-out harus lebih dari tanggal check-in',
        ];
    }
}
