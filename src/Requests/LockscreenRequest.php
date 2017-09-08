<?php

namespace Rangoo\Lockscreen\Requests;

use Rangoo\Lockscreen\Rules\PasswordReconfirm;
use Illuminate\Foundation\Http\FormRequest;

class LockscreenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        	'password' => ['required|min:6', new PasswordReconfirm]
        ];
    }
}
