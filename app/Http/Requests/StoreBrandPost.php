<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreBrandPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 权限
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 规则
     * @return array
     */
    public function rules()
    {
        return [
            // 'brand_name' => 'required|unique:brand',
            'brand_name' => [
                'required',
                Rule::unique('brand')->ignore(request()->id,'brand_id')
            ],
            // 'brand_url' => 'required',
            'brand_url' => [
                'required',
                Rule::unique('brand')->ignore(request()->id,'brand_url')
            ],
        ];
    }
    public function messages(){
        return [
            'brand_name.required'=>'品牌名称必填',
            'brand_name.unique'=>'品牌名称已存在',
            'brand_url.required'=>'品牌网址必填',
            'brand_url.unique'=>'品牌网址已存在',
        ];
    }
}
