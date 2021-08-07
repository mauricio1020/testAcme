<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoRequest extends FormRequest
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
            'plaque' => 'required',
            'color' => 'required',
            'mark' => 'required',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'plaque.*' => 'Placa debe tener un valor',
            'color.*' => 'Debe elgir un color',
            'mark.*' => 'Debe elegir una marca',
            'type.*' => 'Debe legir un tipo',
        ];
    }
}
