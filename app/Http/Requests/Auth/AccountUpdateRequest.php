<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
  public function rules(): array
  {
    return [
      'name' => [
        'required',
      ],
      'birthday' => [
        'required',
        'date'
      ],
      'isStudent' => [
        'nullable', // Cho phép trường này có thể không có giá trị
        'image', // Kiểm tra xem tệp có phải là hình ảnh không
        'mimes:jpeg,png,jpg,gif', // Chỉ chấp nhận các định dạng ảnh cụ thể
        'max:2048' // Giới hạn kích thước tệp tối đa là 2MB
      ],
      'gender' => [
        'required',
      ],
      'email' => [
        'required',
      ],
      'identify_card' => [
        'required',
      ],
    ];
  }
}
