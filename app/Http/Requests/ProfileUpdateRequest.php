<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if(!checkRole()){
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . Auth::user()->id . ',_id'],
                'tgl_lahir' => ['required', 'date'],
                'jekel' => ['required', 'string'],
                'tipe_aktivitas' => ['required', 'string']
            ];
        }
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . Auth::user()->id . ',_id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama User Harus Diisi.',
            'email.required' => 'Email Harus Diisi.',
            'tgl_lahir.required' => 'Tanggal Lahir Harus Diisi.',
            'jekel.required' => 'Jenis Kelamin Harus Diisi.',
            'tipe_aktivitas.required' => 'Tipe Aktivitas Harus Diisi.',
        ];
    }
}
