<?php

namespace App\Http\Requests\Pegawai;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePegawaiRequest extends FormRequest
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
            'id_jabatan' => 'required|numeric',
            'id_divisi' => 'required|numeric',
            'nama_pegawai' => 'required',
            'nik_pegawai' => 'required',
            'alamat_pegawai' => 'required',
            'tgl_lahir_pegawai' => 'required|date',
            'password_pegawai' => 'required'
        ];
    }
}
