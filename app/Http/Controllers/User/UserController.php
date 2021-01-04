<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Presenters\PostPresenter;
use App\Presenters\UserPresenter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 编辑账户资料
     *
     * @return \Inertia\Response
     */
    public function edit()
    {
        return Inertia::render('User/Edit', [
            'user' => UserPresenter::make($this->user())->get(),
        ]);
    }

    /**
     * 更新账户资料
     *
     * @param UpdateUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request)
    {
        $this->user()->update($request->validated());

        return back()->with('success', '帳號更新成功');
    }


    /**
     * 注销账户
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy()
    {
        $user = $this->user();
        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', '帳號刪除成功');
    }

}
