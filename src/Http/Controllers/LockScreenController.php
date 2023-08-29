<?php

namespace DeMemory\LockScreen\Http\Controllers;

use Dcat\Admin\Http\Controllers\AuthController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use DeMemory\LockScreen\LockScreen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LockScreenController extends AuthController
{
    public function lock(Content $content)
    {
        if (!Admin::user())
            return redirect(config('admin.route.prefix'));

        if (!session()->get(LockScreen::LOCK_KEY)) {
            session()->put(LockScreen::LOCK_KEY, url()->previous());
        }

        return $content->full()->body(view('de-memory.lock-screen::index'));
    }

    public function unlock(Request $request)
    {
        if (!Admin::user())
            return redirect(config('admin.route.prefix'));

        $credentials = $request->only(['password']);

        $validator = Validator::make($credentials, ['password' => 'required',], ['required' => '请输入密码！']);

        if ($validator->fails())
            return $this->validationErrorsResponse($validator);

        if (Hash::check(trim($request->get('password')), Admin::user()->password)) {
            session()->forget(LockScreen::LOCK_KEY);

            return $this->sendLoginResponse($request);
        }
        return $this->validationErrorsResponse([
            'password' => '密码错误！',
        ]);
    }
}
