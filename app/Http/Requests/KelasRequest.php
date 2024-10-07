<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KelasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:20',
                Rule::unique('kelas')->where(function ($query) {
                    return $query->where('tahun_ajaran', $this->tahun_ajaran);
                })->ignore($this->id),
            ],
            'tingkat' => 'required|integer|min:1|max:12',
            'tahun_ajaran' => [
                'required',
                'string',
                'regex:/^\d{4}\/\d{4}$/',
                function ($attribute, $value, $fail) {
                    $years = explode('/', $value);
                    if (count($years) !== 2 || $years[1] - $years[0] !== 1) {
                        $fail('Format tahun ajaran harus YYYY/YYYY dan tahun kedua harus 1 tahun setelah tahun pertama.');
                    }
                },
            ],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
