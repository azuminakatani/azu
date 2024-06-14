<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class PasswordResetController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->reset_token = Str::random(60);
            $user->save();

            Mail::to($user->email)->send(new ResetPasswordMail($user));

            return back()->with('status', 'パスワードリセットのリンクを送信しました。');
        }

        return back()->withErrors(['email' => '指定されたメールアドレスは登録されていません。']);
    }

    public function showResetEmailForm()
    {
        return view('auth.email');
    }
    public function showResetForm($token)
    {
        return view('auth.reset', ['token' => $token]);
    }
    
}
