<?php

namespace Rangoo\Lockscreen\Traits;

use Rangoo\Lockscreen\Requests\LockscreenRequest;

trait LockscreenMethods {
	private $unlockFormView = null;

	public function lock() {
		session()->put(config('lockscreen.name', 'lockscreen'), 1);

		$redirectUrl = config('lockscreen.redirect_if_locked', '/lockscreen');

		if(request()->expectsJson())
			return response()->json([
				'locked' => true,
				'suggestUrl' => $redirectUrl
			]);

		return redirect($redirectUrl);
	}

	public function unlock(LockscreenRequest $request) {
		session()->put(config('lockscreen.name', 'lockscreen'), 0);

		return redirect(config('lockscreen.redirect_if_unlocked'));
	}

	public function showUnlockForm() {
		return view($this->getUnlockFormViewName());
	}

	protected function getUnlockFormViewName() {
		if(!is_null($this->unlockFormView)) {
			return $this->unlockFormView;
		}

		return config('lockscreen.unlock_form_view', 'auth.lock');
	}
}