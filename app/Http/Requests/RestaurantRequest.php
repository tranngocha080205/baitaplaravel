<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
{
    /**
     * Xác định xem user có được phép gửi request này không.
     */
    public function authorize(): bool
    {
        return true; // Đổi thành true để request có hiệu lực
    }

    /**
     * Quy tắc kiểm tra dữ liệu của form.
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'img'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Tùy chỉnh thông báo lỗi.
     */
    public function messages()
    {
        return [
            'name.required'        => 'Tên nhà hàng không được để trống.',
            'name.max'             => 'Tên nhà hàng không quá 255 ký tự.',
            'address.required'     => 'Địa chỉ không được để trống.',
            'address.max'          => 'Địa chỉ không quá 255 ký tự.',
            'img.image'            => 'Tệp tải lên phải là hình ảnh.',
            'img.mimes'            => 'Hình ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'img.max'              => 'Dung lượng hình ảnh tối đa là 2MB.',
        ];
    }
}
