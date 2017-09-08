<?php

namespace Rangoo\Lockscreen\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordReconfirm implements Rule
{
	/**
	 * Create a new rule instance.
	 *
	 * @param array $guards
	 *
	 * @throws \Exception
	 */
    public function __construct(...$guards)
    {
    	if(auth()->guest())
    		throw new \Exception('Authentication Error! Request which uses this rule must be under the auth middleware!');
    }

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string $attribute
	 * @param  mixed $value
	 *
	 * @return bool
	 * @throws \Exception
	 */
    public function passes($attribute, $value)
    {
    	if($attribute !== 'password')
    		throw new \Exception('Rule must be used on password property');

    	return auth()->validate([
			'email' => auth()->user()->email,
			'password' => $value
		]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('auth.failed');
    }
}
