<?php

namespace Rangoo\Lockscreen\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordReconfirm implements Rule
{
	private $authorized = null;
	/**
	 * Create a new rule instance.
	 *
	 * @param array $guards
	 */
    public function __construct(...$guards)
    {
    	if(auth()->guest()) {
    		$this->authorized = 'Request which uses PasswordReconfirm rule must be under the auth middleware!';
		}
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
    	return $this->authorized ?? auth()->validate([
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
        return trans('auth.failed','Maybe password is incorrect');
    }
}
