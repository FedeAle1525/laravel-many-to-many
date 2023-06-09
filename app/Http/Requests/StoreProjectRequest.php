<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // Metodo che gestisce l'autorizzazione alla modifica dei dati
    public function authorize()
    {
        // Modifico in 'true' per avere permesso
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    // Metodo che gestisce le regole di 'Validazione'
    public function rules()
    {
        return [

            'name' => 'required|string|max:150|unique:projects,name',
            'description' => 'nullable|string',
            'client' => 'required|string|max:100',
            'url' => 'nullable|url',

            // La FK 'type_id' deve combaciare con gli 'id' (PK) presenti nella Tabella 'Types'
            'type_id' => 'nullable|exists:types,id',

            // Il Parametro da validare è l'Array di Tecnologie (Check Box)
            // Non è necesarrio il 'nullable' perchè in caso non vengano selezionati 'check' non passa nulla
            'technologies' => 'exists:technologies,id'
        ];
    }
}
