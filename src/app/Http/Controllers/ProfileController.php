<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /**
     * Update the user's profile information.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        // アバター画像をstorage/app/publicに保存し、パスを返す
        if ($request->file('avatar')) {
            $dir = 'avatar';
            // s3のdirに保存
            $path = Storage::disk('s3')->putFile($dir, $request->file('avatar'), 'public');
            // パスを格納
            $request->user()->avatar = Storage::disk('s3')->url($path);

            // $path = $request->avatar->store('public/'.$dir);
            // $path = str_replace('public/', 'storage/', $path);
            // avatarカラムの保存内容をファイルからパスに上書き
            // $request->user()->avatar = $path;
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        session()->flash('session_success', 'プロフィールを更新しました');

        return Redirect::route('mypage.show', Auth::id())->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
