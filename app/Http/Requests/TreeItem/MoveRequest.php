<?php

namespace App\Http\Requests\TreeItem;

use Illuminate\Foundation\Http\FormRequest;

class MoveRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start' => 'required|integer|exists:tree_items,id',
            'end' => 'required|integer|exists:tree_items,id',
            'tree_id' => 'required|integer',
        ];
    }
}
