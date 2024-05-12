<?php

namespace App\Http\Requests;

use App\Support\Enums\Roles;
use Illuminate\Foundation\Http\FormRequest;

class ValidateReceiptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authenticatedUser = $this->user();

        return $authenticatedUser->role === Roles::VALIDATOR || $authenticatedUser->role === Roles::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'action' => ['required', 'string', 'in:approved,rejected'],
        ];
    }
}
