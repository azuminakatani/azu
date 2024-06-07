<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // ユーザーをメールアドレスから検索
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // リセットトークンを生成してユーザーのレコードに保存
            $user->reset_token = Str::random(60);
            $user->save();

            // ここでメールを送信するロジックを実装
            // リセットトークンを含むリセットリンクをユーザーに送信する

            return back()->with('status', 'パスワードリセットのリンクを送信しました。');
        }

        return back()->withErrors(['email' => '指定されたメールアドレスは登録されていません。']);
    }

    public function showResetForm()
    {
        return view('auth.reset');
    }
}
