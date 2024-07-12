<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;


class PasswordResetController extends Controller
{
    public function showResetEmailForm(){//メール送信画面
        return view('auth.email');
    }
    
    public function sendResetLinkEmail(Request $request){//メール送信
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => '指定されたメールアドレスは登録されていません。']);
        }

        $token = Str::random(60);
        $user->reset_token = $token;
        $user->save();
        $resetUrl = route('password.reset', ['token' => $token]);

        Mail::to($user->email)->send(new ResetPasswordMail($user, $resetUrl));

        return back()->with('status', 'パスワードリセットのリンクをメールで送信しました。');   
    }

    public function showResetForm($token){//再設定画面へ
        return view('auth.reset', ['token' => $token]);
    }

    public function reset(Request $request){//再設定完了画面へ
        // dd($request);
        /*$request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);*/

        $user = User::where('email', $request->email)->first();

        /*if (! $user || $user->reset_token !== $request->token) {
            return back()->withErrors(['email' => '無効なトークンです。']);
        }*/

        $user->password = Hash::make($request->password);
        $user->reset_token = null;
        $user->save();

        return view('auth.reset_complete');
    }

}
