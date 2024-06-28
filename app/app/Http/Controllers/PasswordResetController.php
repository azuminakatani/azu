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

        $token = Password::broker()->createToken($user);
        $resetUrl = route('password.reset', ['token' => $token]);

        Mail::to($user->email)->send(new ResetPasswordMail($user, $resetUrl));

        return back()->with('status', 'パスワードリセットのリンクをメールで送信しました。');   
    }

    public function showResetForm($token){//再設定画面
        return view('auth.reset', ['token' => $token]);
    }

    public function reset(Request $request){//再設定
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('password.reset.complete');
        } else {
            return back()->withErrors(['email' => [trans($status)]]);
        }
    }

    public function showResetCompleteForm(){//完了画面
        return view('auth.reset_complete');
    }
}
