<?php

namespace Jubilee\Auth\Http\Requests\Auth;

use Jubilee\Auth\Http\Requests\BaseFormRequest;

class RegisterRequest extends BaseFormRequest
{
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->get('email');
    }

    /**
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->get('password');
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|string',
            'password' => 'required|min:5|alpha_num|confirmed',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required'     => 'email是必填欄位',
            'email.string'       => 'email是字串類型',
            'password.required'  => 'password是必填欄位',
            'password.min'       => 'password小於5個字',
            'password.alpha_num' => 'password必須包含數字及字母',
            'password.confirmed' => 'password 確認輸入錯誤'
        ];
    }
}
