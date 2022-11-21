<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanStoreRequest extends FormRequest
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
            'kode_buku' => 'required',
            'kode_anggota' => 'required',
            'durasi_peminjaman' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'kode_buku.required' => 'Kode Buku is required!',
            'kode_anggota.required' => 'Kode Anggota is required!',
            'durasi_peminjaman.required' => 'Durasi Peminjaman is required!'
        ];
    }
}
