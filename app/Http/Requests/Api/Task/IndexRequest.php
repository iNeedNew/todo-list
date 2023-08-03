<?php

namespace App\Http\Requests\Api\Task;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => 'in:todo,done',
            'priority_from' => ['integer', 'between:1,5'],
            'priority_to' => ['integer', 'between:1,5'],
            'sort_by' => 'in:created_at,completed_at,priority',
            'order' => 'in:desc,asc',
            'search' => 'max:255'
        ];
    }
}
