<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class CreateProdukRequest extends FormRequest
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
            'id_supplier' => 'required',
            'nama_produk' => 'required',
            'stok' => 'required|numeric',
            'harga_produk' => 'required|numeric',
            'berat_produk' => 'required|numeric',
            'deskripsi_produk' => 'required',
            'foto_produk' => 'required|image:jpeg,png,jpg|max:2048',
        ];
    }
}
