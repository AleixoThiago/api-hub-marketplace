<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'product_ref' => 'required|alpha_num',
            'scope' => 'required|in:price,stock,status',
            'price' => $this->getPriceValidationRule($this->input('scope')),
            'stock' => $this->getStockValidationRule($this->input('scope')),
            'status' => $this->getStatusValidationRule($this->input('scope')),
        ];
    }

    private function getPriceValidationRule($scope)
    {
        return $scope == 'price' ? 'required|numeric' : '';
    }

    private function getStockValidationRule($scope)
    {
        return $scope == 'stock' ? 'required|integer' : '';
    }

    private function getStatusValidationRule($scope)
    {
        return $scope == 'status' ? 'required|in:active,inactive' : '';
    }
}
