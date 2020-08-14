<?php

namespace Jubilee\Auth\Http\Requests;

class LoginRequest extends BaseFormRequest
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
    public function getLoginPassword(): string
    {
        return $this->get('password');
    }

    /**
     * @inheritDoc
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    /**
     * @inheritDoc
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'email.required'    => 'email為必填欄位',
            'email.string'      => 'email字串類型',
            'email.email'       => '輸入必須為email格式',
            'password.required' => 'password為必填欄位',
            'password.string'   => 'password為字串類型',
        ];
    }
}
