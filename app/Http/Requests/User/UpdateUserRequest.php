<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required',
            'alamat_user' => 'required|min:5|max:100',
            'tgl_lahir_user' => 'required|date',
            'jenis_kelamin_user' => 'required',
            'password' => 'required'
        ];
    }
}
