<?php

namespace Jubilee\Auth\Http\Requests\Facebook;

use Jubilee\Auth\Http\Requests\BaseFormRequest;

class FeedBackRequest extends BaseFormRequest
{
    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->get('code');
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->get('state');
    }

    /**
     * @return int|null
     */
    public function getErrorCode(): ?int
    {
        return $this->get('error_code');
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->get('error_message');
    }

    /**
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
            'code'          => 'sometimes|required|string',
            'state'         => 'sometimes|required|string',
            'error_code'    => 'sometimes|required|integer',
            'error_message' => 'sometimes|required|string'
        ];
    }
}
