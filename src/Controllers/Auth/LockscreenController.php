<?php

namespace Rangoo\Lockscreen\Controllers\Auth;

use App\Http\Controllers\Controller;
use Rangoo\Lockscreen\Requests\LockscreenRequest;

class LockscreenController extends Controller
{
	public function lock() {
		session()->put('lockscreen', 1);

		$redirectUrl = '/lockscreen';

		if(request()->expectsJson())
			return response()->json([
				'locked' => true,
				'suggestUrl' => $redirectUrl
			]);
		return redirect($redirectUrl);
	}

	public function unlock(LockscreenRequest $request) {
		session()->put('lockscreen', 0);

		return redirect('/');
	}

	public function showUnlockForm() {
		return view('auth.lock');
	}
}
