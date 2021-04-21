<?php

namespace App\Http\Requests\Retur;

use Illuminate\Foundation\Http\FormRequest;

class ValidasiReturRequest extends FormRequest
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
            'id_retur' => 'required|numeric',
            'id_pegawai' => 'required|numeric',
            'password_pegawai' => 'required'
        ];
    }
}
