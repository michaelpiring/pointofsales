<?php

namespace App\Http\Requests\Toko;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTokoRequest extends FormRequest
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
            'nama_toko' => 'required|max:30',
            'alamat_toko' => 'required|max:100',
            'no_telepon_toko' => 'required|numeric',
            'id_pegawai' => 'required|numeric',
            'password_pegawai' => 'required'
        ];
    }
}
