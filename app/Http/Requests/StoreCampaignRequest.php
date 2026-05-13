<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'template_id' => [
                'required',
                'exists:templates,id',
            ],

            'contacts' => ['required', 'array'],

            'contacts.*' => ['exists:contacts,id'],

            'scheduled_at' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not be greater than 255 characters.',

            'template_id.required' => 'The email template field is required.',
            'template_id.exists' => 'The selected email template is invalid.',

            'contacts.required' => 'The contacts field is required.',
            'contacts.array' => 'The contacts must be an array.',

            'contacts.*.exists' => 'The selected contact is invalid.',

            'scheduled_at.date' => 'The scheduled at must be a valid date.',
        ];
    }
}
