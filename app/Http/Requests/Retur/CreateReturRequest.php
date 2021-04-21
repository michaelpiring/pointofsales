<?php

namespace App\Http\Requests\Retur;

use Illuminate\Foundation\Http\FormRequest;

class CreateReturRequest extends FormRequest
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
            'id_toko' => 'required|numeric',
            'id_produk' => 'required|numeric',
            'id_pegawai' => 'required|numeric',
            'id_supplier' => 'required|numeric',
            'jumlah_barang' => 'required|numeric',
            'keterangan' => 'required',
            'status' => 'required'
        ];
    }
}
