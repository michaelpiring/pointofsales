<?php

namespace App\Http\Requests\Pegawai;

use Illuminate\Foundation\Http\FormRequest;

class CreatePegawaiRequest extends FormRequest
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
            'id_toko',
            'id_jabatan',
            'id_divisi',
            'nama_pegawai',
            'email_pegawai',
            'password_pegawai',
            'nik_pegawai',
            'alamat_pegawai',
            'tgl_lahir_pegawai'
        ];
    }
}
