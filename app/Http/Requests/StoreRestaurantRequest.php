<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRestaurantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cho phép validate
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên nhà hàng là bắt buộc.',
            'address.required' => 'Địa chỉ là bắt buộc.',
            'img.image' => 'Tệp tải lên phải là hình ảnh.',
            'img.mimes' => 'Chỉ chấp nhận định dạng jpeg, png, jpg, gif.',
            'description.max' => 'Mô tả không quá 1000 ký tự.',
        ];
    }
}
