<?php

namespace App\Http\Requests\Hutang;

use Illuminate\Foundation\Http\FormRequest;

class PembayaranHutangRequest extends FormRequest
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
            'id_hutang' => 'required|numeric',
            'id_user' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric'
        ];
    }
}
