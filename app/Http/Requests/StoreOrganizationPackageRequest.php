<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationPackageRequest extends FormRequest
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
            'organizationPackageName' => 'nullable',
            'organizationPackageDuration' => 'nullable',
            'organizationPackageQuantity' => 'nullable',
            'limitBillGenerate' => 'nullable',
            'price' => 'nullable',
            'organizationEmployeeLimitation' => 'nullable',
        ];
    }
}
