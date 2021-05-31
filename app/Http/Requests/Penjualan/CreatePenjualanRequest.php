<?php

namespace App\Http\Requests\Penjualan;

use Illuminate\Foundation\Http\FormRequest;

class CreatePenjualanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_checkout' => 'required|numeric',
            'id_pegawai' => 'required|numeric',
            'id_toko' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric'
        ];
    }
}
