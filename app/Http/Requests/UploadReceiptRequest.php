<?php

namespace App\Http\Requests;

use App\Support\Enums\Roles;
use Illuminate\Foundation\Http\FormRequest;

class UploadReceiptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role === Roles::UPLOADER || $this->user()->role === Roles::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company' => ['required', 'string'],
            'cuserial' => ['required', 'string'],
            'cuin' => ['required', 'string'],
            'seller' => ['required', 'string'],
            'pin' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'vat_percentage' => ['required', 'numeric'],
            'purchase_date' => ['required', 'date'],
            'receipt' => ['required', 'file', 'mimes:jpeg,png,jpg,jfif,gif,svg', 'max:2048'],
        ];
    }
}
