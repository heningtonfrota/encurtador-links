<?php

namespace App\Http\Requests;

use App\Models\Link;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLinkRequest extends FormRequest
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
        $slugRule = 'nullable';
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $link = Link::find($this->route('link'));
            $slugRule = $link->slug === $this->input('slug') ? 'nullable' : 'nullable|unique:links,slug';
        }

        return [
            'link' => 'required',
            'slug' => $slugRule,
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'O campo é obrigatório!',
            'unique' => 'O campo deve ser unico!'
        ];
    }
}
