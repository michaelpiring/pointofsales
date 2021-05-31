<?php

namespace App\Http\Requests\PromoSupplier;

use Illuminate\Foundation\Http\FormRequest;

class CreatePromoSupplierRequest extends FormRequest
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
            'id_supplier' => 'required|numeric',
            'kode_promo' => 'required|unique:tb_promo_produk,kode_promo|unique:tb_promo_diskon,kode_promo|unique:tb_promo_supplier,kode_promo',
            'besar_promo_diskon' => 'required|numeric',
            'tgl_mulai_diskon' => 'required|date',
            'tgl_berakhir_diskon' => 'required|date',
            'keterangan' => 'required|max:100'
        ];
    }
}
