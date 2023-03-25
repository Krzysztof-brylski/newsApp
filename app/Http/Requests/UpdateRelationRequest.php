<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRelationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'prev_message'=>'required|exists:App\Models\LiveRelationMessage,id',
            'relation_title'=>'required|string|max:200',
            'title'=>'required|string|max:200',
            'content'=>'required|string|max:500',
        ];
    }
}
