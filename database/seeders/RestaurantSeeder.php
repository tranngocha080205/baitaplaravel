<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
{
    /**
     * Xác định người dùng có quyền gửi request này không.
     */
    public function authorize(): bool
    {
        return true; // Cho phép tất cả user gửi request này
    }

    /**
     * Định nghĩa các rules kiểm tra dữ liệu.
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'address'     => 'required|string|max:500',
            'phone'       => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
            'description' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi.
     */
    public function messages(): array
    {
        return [
            'name.required'        => 'Tên nhà hàng không được để trống.',
            'name.string'          => 'Tên nhà hàng phải là chuỗi ký tự.',
            'name.max'             => 'Tên nhà hàng không được vượt quá 255 ký tự.',
            
            'address.required'     => 'Địa chỉ không được để trống.',
            'address.string'       => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max'          => 'Địa chỉ không được vượt quá 500 ký tự.',
            
            'phone.required'       => 'Số điện thoại không được để trống.',
            'phone.regex'          => 'Số điện thoại không hợp lệ. Vui lòng nhập đúng định dạng.',

            'description.string'   => 'Mô tả phải là chuỗi ký tự.',
            'description.max'      => 'Mô tả không được vượt quá 1000 ký tự.',
        ];
    }
}
